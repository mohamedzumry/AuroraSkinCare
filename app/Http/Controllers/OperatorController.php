<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function makeAppointment()
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

        Appointment::makeAppointment($validated);
        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully!');
    }
}
