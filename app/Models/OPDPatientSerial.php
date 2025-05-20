<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OPDPatientSerial extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'date',
        'doctor_id',
        'serial',
        'status',
    ];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($patientSerial) {
            $date = $patientSerial->date;
            $lastSerial = self::where('doctor_id', $patientSerial->doctor_id)
                ->where('date', $date)
                ->max('serial');

            $patientSerial->serial = $lastSerial ? $lastSerial + 1 : 1;
        });
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }



    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function opdPrescription()
    {
        return $this->hasOne(OPDPrescription::class, 'opd_patient_serial_id');
    }

}
