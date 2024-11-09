<?php

namespace App\Models;

class Doctor extends User
{
    
    private static $doctors = [
        [
            'name' => 'Dr. John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '1234567890',
            'nic' => '123456789',
        ],
        [
            'name' => 'Dr. Jane Smith',
            'email' => 'janesmith@example.com',
            'phone' => '0987654321',
            'nic' => '987654321',
        ],
    ];

    public static function getDoctors()
    {
        return collect(self::$doctors)->map(function ($doctorData) {
            $doctor = new self();
            $doctor->fill($doctorData);
            return $doctor;
        });
    }
}
