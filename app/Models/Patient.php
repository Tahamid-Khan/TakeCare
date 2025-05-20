<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($patient) {
            $latestPatient = self::latest()->first();
            $lastId = $latestPatient ? intval(substr($latestPatient->patient_id, 3)) : 0;
            $patient->patient_id = 'P' . str_pad($lastId + 1, 6, '0', STR_PAD_LEFT);
        });
    }


    public function patientStatus(): HasMany
    {
        return $this->hasMany(PatientStatus::class);
    }

    public function patientMedicine(): HasMany
    {
        return $this->hasMany(PatientMedicine::class);
    }

    public function PatientDailySummary(): HasMany
    {
        return $this->hasMany(PatientDailySummary::class);
    }

    public function patientDoctorAssignment(): HasMany
    {
        return $this->hasMany(PatientDoctorAssignment::class);
    }

    public function previousHistory(): HasMany
    {
        return $this->hasMany(PreviousHistory::class);
    }

    public function bed(): BelongsTo
    {
        return $this->belongsTo(Bed::class);
    }

    public function operation(): HasMany
    {
        return $this->hasMany(Operation::class);
    }

    public function icuPatient(): HasMany
    {
        return $this->hasMany(ICUPatient::class);
    }

    // doctor
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patientDischarge(): HasMany
    {
        return $this->hasMany(PatientDischarge::class);
    }
    public function patientDischargeNew(): HasMany
    {
        return $this->hasMany(PatientDischarge::class)->where('status','=', 'pending')->orWhere('status','=', 'generated')->orWhere('status','=', 'doctor_approved');
    }

    public function patientAdmitRequest(): HasMany
    {
        return $this->hasMany(PatientAdmitRequest::class);
    }

    public function medicineServeLog(): HasMany
    {
        return $this->hasMany(MedicineServeLog::class);
    }

    public function patientRefer(): HasMany
    {
        return $this->hasMany(PatientRefer::class);
    }

    public function patientDue(): HasMany
    {
        return $this->hasMany(PatientInvoice::class)->where('payment_status', '!=', 'paid');

    }
    public function patientInvoice(): HasMany
    {
        return $this->hasMany(PatientInvoice::class);
    }





}
