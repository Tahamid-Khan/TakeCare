<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreItemLot extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_product_id',
        'lot_number',
        'expiry_date',
        'quantity',
        'has_expiry_date',
        'price',
    ];
    public function product()
    {
        return $this->belongsTo(StoreProduct::class, 'store_product_id', 'id');
    }
}
