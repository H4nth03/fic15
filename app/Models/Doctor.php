<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Doctor extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'doctor_name',
        'doctor_email',
        'doctor_phone',
        'doctor_specialist',
        'photo',
        'address',
        'sip',
    ];

}
