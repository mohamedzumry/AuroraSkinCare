<?php

namespace App\Models;

class Operator extends User
{
    public static function createAppointment($data)
    {
        $invoice = new Invoice();
        return $invoice->createInvoice($data);
    }

    public static function editAppointment($data)
    {
        $invoice = new Invoice();
        return $invoice->createInvoice($data);
    }

    public static function deleteAppointment($id)
    {
        $invoice = new Invoice();
        return $invoice->deleteInvoice($id);
    }

    public static function viewAppointment($id)
    {
        $invoice = new Invoice();
        return $invoice->showInvoice($id);
    }

    public static function viewAllAppointments()
    {
        $invoice = new Invoice();
        return $invoice->getInvoices();
    }

    public static function createInvoice($data)
    {
        $invoice = new Invoice();
        return $invoice->createInvoice($data);
    }

    public static function viewInvoice($id)
    {
        $invoice = new Invoice();
        return $invoice->showInvoice($id);
    }

    public static function viewAllInvoices()
    {
        $invoice = new Invoice();
        return $invoice->getInvoices();
    }

}
