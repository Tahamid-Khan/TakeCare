<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmergencyPrescription extends Model
{
    use HasFactory;

    protected $fillable = ['emergency_patient_id', 'prescription'];

    public function emergencyPatient(): BelongsTo
    {
        return $this->belongsTo(EmergencyPatient::class);
    }


}
