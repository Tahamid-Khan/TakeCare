<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pathology extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'service_id',
        'delivery_date',
        'test_date',
        'remarks',
        'materials',
        'status',
        'invoice_id'
    ];


    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(PatientInvoice::class);
    }
}
