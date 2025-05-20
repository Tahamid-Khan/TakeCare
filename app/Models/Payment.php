<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_invoice_id',
        'payable',
        'due',
        'paid_now',
        'payment_method',
        'transaction_id',
    ];


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($payment) {
            $payment->transaction_id = $payment->patient_invoice_id . time();
        });
    }


    public function patientInvoice(): BelongsTo
    {
        return $this->belongsTo(PatientInvoice::class);
    }
}
