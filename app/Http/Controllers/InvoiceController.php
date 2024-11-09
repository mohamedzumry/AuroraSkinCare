<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class InvoiceController extends Controller
{
    public function index()
    {
        // remove all invoice sessions
        // Session::remove('invoices');
        // Session::forget('invoice');
        $invoices = Invoice::getInvoices();
        return view('invoice.index', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = Invoice::getInvoiceById($id);
        return view('invoice.show', compact('invoice'));
    }

    public function create($id)
    {
        $appointment = collect(Appointment::getAppointments())->firstWhere('id', $id);
        if (!$appointment) {
            return redirect()->route('appointments.index')->withErrors('Appointment not found.');
        } else {
            $treatments = Treatment::$treatments;
            return view('invoice.create', compact('appointment', 'treatments'));
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointmentId' => 'required',
            'treatmentName' => 'required',
            'tax' => 'required|numeric',
            'status' => 'required',
        ]);


        // Find the appointment
        $appointment = collect(Appointment::getAppointments())->firstWhere('id', $validated['appointmentId']);

        // Check if appointment exists
        if (!$appointment) {
            return back()->withErrors(['appointmentId' => 'Appointment not found.'])->withInput();
        }

        // Retrieve treatment price
        $treatmentPrices = Treatment::$treatments;
        $price = $treatmentPrices[$validated['treatmentName']] ?? 0;

        $registration_fee = $appointment['registration_fee'];

        // Calculate tax and total
        $tax = ($price + $registration_fee) * ($validated['tax'] / 100);
        $total = $price + $registration_fee + $tax;
        $validated['total'] = $total;

        // Populate validated data with appointment details
        $validated['patient_name'] = $appointment['patient_name'];
        $validated['patient_email'] = $appointment['patient_email'];
        $validated['patient_phone'] = $appointment['patient_phone'];
        $validated['patient_nic'] = $appointment['patient_nic'];
        $validated['doctor'] = $appointment['doctor'];
        $validated['appointment_date'] = $appointment['date'];
        $validated['appointment_time'] = $appointment['time'];
        $validated['registration_fee'] = $appointment['registration_fee'];
        $validated['treatment_name'] = $validated['treatmentName'];
        $validated['treatment_price'] = $price;
        $validated['created_time'] = Carbon::now()->toDateTimeString();
        unset($validated['treatmentName']);

        // Create the invoice
        Invoice::createInvoice($validated);

        return redirect()->route('invoice.index')->with('success', 'Invoice created successfully!');
    }

}
