<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PatientInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'invoice_number',
        'invoice_date',
        'fund_department_id',
        'service_name',
        'total_price',
        'discount',
        'final_price',
        'due_amount',
        'payment_status',

    ];

//    boot for invoice number as search the latest then +1
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->invoice_number = 'INV' . $model->patient_id . $model->fund_department_id . date('Ymd') . (PatientInvoice::where('fund_department_id', $model->fund_department_id)->count() + 1);
        });
    }


    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function fundDepartment(): BelongsTo
    {
        return $this->belongsTo(FundDepartment::class);
    }
}
