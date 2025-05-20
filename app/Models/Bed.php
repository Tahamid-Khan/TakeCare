<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bed extends Model
{

//    ward_id--
//1 = icu
//2 = pow
    use HasFactory;

    protected $fillable = [
        'ward_id',
        'bed_number',
        'bed_type',
        'bed_status',
        'patient_id',
    ];

    public function Ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function icuPatient(): HasOne
    {
        return $this->hasOne(ICUPatient::class);
    }

}
