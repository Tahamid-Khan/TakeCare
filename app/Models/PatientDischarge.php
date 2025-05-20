<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDischarge extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'doctor_id', 'discharge_date', 'details', 'status'];

    protected $casts = [
        'details' => 'array',
        'discharge_date' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }


}
