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
            if (empty($patient->patient_id)) {
                $patient->patient_id = self::generateUniquePatientId();
            }
        });
    }

    /**
     * Generate a unique patient ID - prevents duplicates
     */
    private static function generateUniquePatientId(): string
    {
        // Try sequential approach first (up to 5 attempts)
        for ($attempt = 1; $attempt <= 5; $attempt++) {
            // Get the latest patient by patient_id numeric value
            $latestPatient = self::whereNotNull('patient_id')
                               ->orderByRaw('CAST(SUBSTRING(patient_id, 2) AS UNSIGNED) DESC')
                               ->first();
            
            $lastId = 0;
            if ($latestPatient && $latestPatient->patient_id) {
                // Extract numeric part from patient_id (e.g., P000001 -> 1)
                $numericPart = preg_replace('/[^0-9]/', '', $latestPatient->patient_id);
                $lastId = $numericPart ? intval($numericPart) : 0;
            }
            
            // Try next sequential number with attempt offset to avoid collisions
            $nextId = $lastId + $attempt;
            $patientId = 'P' . str_pad($nextId, 6, '0', STR_PAD_LEFT);
            
            // Check if this ID already exists
            if (!self::where('patient_id', $patientId)->exists()) {
                return $patientId;
            }
        }
        
        // Fallback: use timestamp-based unique ID (guaranteed unique)
        $timestamp = now()->format('ymdHis'); // YearMonthDayHourMinuteSecond (12 digits)
        $micro = substr(str_replace('.', '', microtime(true)), -3); // Last 3 digits
        return 'P' . $timestamp . $micro;
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
