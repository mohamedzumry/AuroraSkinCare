<?php

namespace App\Models;

use Hamcrest\Arrays\IsArray;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Appointment extends Model
{

    protected $fillable = [
        'id',
        'date',
        'time',
        'doctor',
        'patient_nic',
        'patient_name',
        'patient_email',
        'patient_phone',
        'registration_fee',        
    ];


    public static function makeAppointment($data)
    {
        $appointments = Session::get('appointments', []);
        
        // Assign an ID to the appointment and add timestamp
        $data['id'] = count($appointments) + 1;
        $data['created_at'] = now();

        $appointment = new self();
        $appointment->fill($data);

        $appointments[] = $appointment;
        Session::put('appointments', $appointments);
    }

    public static function getAppointments()
    {
        // Retrieve all appointments from session
        return Session::get('appointments', []);
    }

    public static function updateAppointment($id, $newData)
    {
        // Retrieve appointments from session
        $appointments = Session::get('appointments', []);

        // Find and update the appointment by ID
        foreach ($appointments as $index => $appointment) {
            if ($appointment['id'] == $id) {
                $appointments[$index] = array_merge(is_array($appointment) ? $appointment : (array) $appointment->toArray(), $newData);
                Session::put('appointments', $appointments);
                return true;
            }
        }
        return false;
    }

    public static function deleteAppointment($id)
    {
        // Retrieve appointments from session
        $appointments = Session::get('appointments', []);

        // Filter out the appointment by ID
        $appointments = array_filter($appointments, fn($appointment) => $appointment['id'] != $id);
        Session::put('appointments', array_values($appointments));
    }

    public static function generateTimeSlots($startTime, $endTime)
    {
        $start = new \DateTime($startTime);
        $end = new \DateTime($endTime);

        $slots = [];
        while ($start < $end) {
            $slots[] = $start->format('H:i');
            $start->modify('+15 minutes');
        }

        return $slots;
    }

    public static function getAvailableTimeSlots($date)
    {
        $dayOfWeek = date('l', strtotime($date));

        $schedules = [
            'Monday' => ['10:00', '13:00'],
            'Wednesday' => ['14:00', '17:00'],
            'Friday' => ['16:00', '20:00'],
            'Saturday' => ['09:00', '13:00']
        ];

        if (!isset($schedules[$dayOfWeek])) {
            return [];
        }

        return self::generateTimeSlots($schedules[$dayOfWeek][0], $schedules[$dayOfWeek][1]);
    }
}