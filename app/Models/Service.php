<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
        'price',
        'description',
        'status'
    ];


    public function department(): BelongsTo
    {
        return $this->belongsTo(FundDepartment::class, 'department_id');
    }

    public function operations(): HasMany
    {
        return $this->hasMany(Operation::class);
    }
}
