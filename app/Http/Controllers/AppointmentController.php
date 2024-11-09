<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Treatment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointments = session()->get('appointments', []);

        // Filter by date if provided
        if ($request->filled('date')) {
            $appointments = array_filter($appointments, function ($appointment) use ($request) {
                return $appointment['date'] === $request->date;
            });
        }

        // Search by patient name or appointment ID if provided
        if ($request->filled('query')) {
            $appointments = array_filter($appointments, function ($appointment) use ($request) {
                return stripos($appointment['patient_name'], $request['query']) !== false || $appointment['id'] == $request['query'];
            });
        }

        return view('appointments.index', ['appointments' => $appointments]);
    }

    public function create()
    {
        $doctors = Doctor::getDoctors();
        $slots = Appointment::generateTimeSlots('9:00', '20:00');
        return view('appointments.create', compact('slots', 'doctors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'doctor' => 'required',
            'patient_nic' => 'required|string|max:12|min:12',
            'patient_name' => 'required|string',
            'patient_email' => 'required|email',
            'patient_phone' => 'required|string|max:10|min:10',
            'registration_fee' => 'required|numeric',
        ]);

        $availableSlots = Appointment::getAvailableTimeSlots($validated['date']);

        if (!in_array($validated['time'], $availableSlots)) {
            return back()->withErrors(['time' => 'The selected time is not available.'])->withInput();
        }

        // Check if selected time is already booked for particular doctor
        $appointmentsOnDate = collect(Appointment::getAppointments())->where('date', $validated['date'])->where('doctor', $validated['doctor']);
        if ($appointmentsOnDate->contains('time', $validated['time'])) {
            return back()->withErrors(['time' => 'The selected time is already taken for selected doctor. Please choose another slot/doctor.'])->withInput();
        }

        // Check if 

        Appointment::makeAppointment($validated);
        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully!');
    }

    public function edit($id)
    {
        $appointment = collect(Appointment::getAppointments())->firstWhere('id', $id);
        if (!$appointment) {
            return redirect()->route('appointments.index')->withErrors('Appointment not found.');
        }

        $doctors = Doctor::getDoctors();
        $slots = Appointment::generateTimeSlots('9:00', '20:00');

        return view('appointments.edit', compact('appointment', 'slots', 'doctors'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'doctor' => 'required',
            'patient_nic' => 'required|string|max:12|min:12',
            'patient_name' => 'required|string',
            'patient_email' => 'required|email',
            'patient_phone' => 'required|string|max:10|min:10',
            'registration_fee' => 'required|numeric',
        ]);

        $availableSlots = Appointment::getAvailableTimeSlots($validated['date']);
        if (!in_array($validated['time'], $availableSlots)) {
            return back()->withErrors(['time' => 'The selected time is not available on selected date.'])->withInput();
        }

        // Check if selected time is already booked
        $appointmentsOnDate = collect(Appointment::getAppointments())->where('date', $validated['date'])->where('id', '!=', $id)->where('doctor', $validated['doctor']);
        
        if ($appointmentsOnDate->contains('time', $validated['time'])) {
            return back()->withErrors(['time' => 'The selected time is already taken for selected doctor. Please try another slot/doctor.'])->withInput();
        }

        Appointment::updateAppointment($id, $validated);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully!');
    }

    public function delete($id)
    {
        Appointment::deleteAppointment($id);
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }

    public function show($id)
    {
        //  $price = Treatment::$prices[$appointment['treatment']];
        // $tax = $price * 0.025;
        // $total = round($price + $tax, 2);
        $appointment = collect(Appointment::getAppointments())->firstWhere('id', $id);
        return view('appointments.show', compact('appointment'));
    }

    public function availableTimes(Request $request)
    {
        $date = $request->input('date');

        if (!$date) {
            return response()->json(['error' => 'Date is required'], 400);
        }

        $timeSlots = Appointment::getAvailableTimeSlots($date);

        return response()->json($timeSlots);
    }
}
