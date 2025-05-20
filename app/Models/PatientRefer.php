<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientRefer extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'referred_by',
        'hospital_id',
        'remark',
        'status'
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'referred_by');
    }

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }


}
