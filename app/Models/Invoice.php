<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Invoice extends Model
{
    protected $fillable = [
        'id',
        'appointment_date',
        'appointment_time',
        'registration_fee',
        'patient_name',
        'patient_email',
        'patient_phone',
        'patient_nic',
        'doctor',
        'treatment_name',
        'treatment_price',
        'tax',
        'total',
        'status',
        'created_time'
    ];

    public static function createInvoice($data)
    {
        // Retrieve existing invoices from the session
        $invoices = Session::get('invoices', []);

        // // Assign an ID to the new invoice and add a timestamp
        $data['id'] = count($invoices) + 1;

        // Create a new invoice object and set properties
        $invoice = new self();
        $invoice->fill($data);

        // // Add the new invoice to the invoices array
        $invoices[] = $invoice;

        // // Store the updated invoices array back in the session
        Session::put('invoices', $invoices);

        // // Remove the particular appointment from the session
        Appointment::deleteAppointment($data['appointmentId']);
    }


    public static function getInvoices()
    {
        // Retrieve all invoices from session
        return Session::get('invoices', []);
    }

    public static function getInvoiceById($id)
    {
        return collect(Invoice::getInvoices())->firstWhere('id', $id);
    }

}
