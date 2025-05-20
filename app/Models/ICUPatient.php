<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICUPatient extends Model
{
    use HasFactory;

    // protected $guarded = [];

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'bed_id',
        'isICU',
        'referredHospital',
        'isDischarged',
    ];

    protected $casts = [
        'isICU' => 'boolean',
        'isDischarged' => 'boolean',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }


}
