<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StoreProduct extends Model
{
    use HasFactory;
    protected  $fillable =[
        'name',
        'image',
        'price',
        'product_id',
        'item_type_id',
        'department_id',
    ];
//make product_id in boot function with padding
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Get the highest id
            $maxId = StoreProduct::max('id');

            // Increment the id by 1
            $nextId = $maxId + 1;

            // Pad the number with leading zeros
            $model->product_id = 'PR' . str_pad($nextId, 5, '0', STR_PAD_LEFT);
        });
    }

    public function inventory(): HasOne
    {
        return $this->hasOne(StoreInventory::class, 'product_id', 'id');
    }

    public function materialRequest(): HasMany
    {
        return $this->hasMany(StoreMaterialRequest::class, 'product_id', 'id');
    }

    public function itemType(): BelongsTo
    {
        return $this->belongsTo(StoreItemType::class, 'item_type_id', 'id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(StoreDepartment::class, 'department_id', 'id');
    }
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(StoreVendor::class, 'vendor_id', 'id');
    }
    public function lots(): HasMany
    {
        return $this->hasMany(StoreItemLot::class, 'store_product_id', 'id');
    }
}
