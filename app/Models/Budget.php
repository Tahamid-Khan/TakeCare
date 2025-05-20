<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'forMonth',
        'amount',
        'department_id',
        'slug',
        'items',
        'expense'
    ];

    public function fundDepartment(): BelongsTo
    {
        return $this->belongsTo(FundDepartment::class, 'department_id');
    }
}
