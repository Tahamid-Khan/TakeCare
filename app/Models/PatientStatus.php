<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'user_id',
        'pulse_rate',
        'blood_pressure',
        'temperature',
        'oxygen_level',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
