<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'area_of_concern',
        'preferred_doctor',
        'preferred_date',
        'reason_for_visit',
        'user_id',
    ];

    protected $casts = [
        'preferred_date' => 'date',
    ];
}