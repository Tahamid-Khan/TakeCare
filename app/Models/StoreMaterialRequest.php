<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreMaterialRequest extends Model
{
    use HasFactory;

    protected  $fillable = [
        'product_id',
        'requested_from',
        'quantity',
        'status',
        'updated_by'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(StoreProduct::class, 'product_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
