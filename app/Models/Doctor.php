<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    use HasFactory;
    protected $guarded = [];

//    boot for doctor_id
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($doctor) {
            $doctor->doctor_id = 'DR' . str_pad(Doctor::count() + 1, 4, '0', STR_PAD_LEFT);
        });
    }

    public function patient(): HasMany
    {
        return $this->hasMany(Patient::class);
    }
    // department
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    // patient doctor assignment
    public function patientDoctorAssignment(): HasMany
    {
        return $this->hasMany(PatientDoctorAssignment::class);
    }
    // operation
    public function operation(): HasMany
    {
        return $this->hasMany(Operation::class);
    }
    // icu patient
    public function icuPatient(): HasMany
    {
        return $this->hasMany(ICUPatient::class);
    }
    // pow patient
    public function powPatient(): HasMany
    {
        return $this->hasMany(POWPatient::class);
    }

    public function patientDischarge(): HasMany
    {
        return $this->hasMany(PatientDischarge::class);
    }

    public function patientAdmitRequest(): HasMany
    {
        return $this->hasMany(PatientAdmitRequest::class);
    }

    public function patientRefer(): HasMany
    {
        return $this->hasMany(PatientRefer::class, 'referred_by');
    }


}
