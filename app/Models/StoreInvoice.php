<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreInvoice extends Model
{
    use HasFactory;
    protected  $fillable=[
        'invoice_no',
        'created_by',
        'name',
        'phone',
        'address',
        'total_bill',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(StoreInvoice::class, 'invoice_no', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
