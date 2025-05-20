<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMedicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'patient_id',
        'doctor_id',
        'schedule',
        'medicine_name',
        'taking_time',
        'dose',
        'duration',
        'status',
        'created_by',
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
