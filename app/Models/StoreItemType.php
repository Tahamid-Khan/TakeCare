<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StoreItemType extends Model
{
//    use HasFactory;
    protected  $fillable =[
        'name',
        'department_id'
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(StoreDepartment::class, 'department_id', 'id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(StoreProduct::class, 'item_type_id', 'id');
    }
}
