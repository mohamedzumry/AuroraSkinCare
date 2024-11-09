<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

// Appointments

Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');

Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments/create', [AppointmentController::class, 'store'])->name('appointments.store');

Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show');
Route::put('/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');
Route::delete('/appointments/{id}', [AppointmentController::class, 'delete'])->name('appointments.delete');
Route::get('/appointments/{id}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');

Route::get('/appointments/available-times', [AppointmentController::class, 'availableTimes'])->name('appointments.availableTimes');


// Invoices

Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice.index');

Route::get('/invoice/create/{id}', [InvoiceController::class, 'create'])->name('invoice.create');
Route::post('/invoice/create', [InvoiceController::class, 'store'])->name('invoice.store');

Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');

