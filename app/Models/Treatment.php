<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    public $treatment_name;
    public $treatment_price;

    protected $fillable = [
        'treatment_name',
        'treatment_price',
    ];

    public static $treatments = [
        'Acne Treatment' => 2750.00,
        'Skin Whitening' => 7650.00,
        'Mole Removal' => 3850.00,
        'Laser Treatment' => 12500.00,
    ];
}
