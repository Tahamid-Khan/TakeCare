<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'amount',
        'purpose',
        'date',
    ];

    public function fundDepartment(): BelongsTo
    {
        return $this->belongsTo(FundDepartment::class, 'department_id');
    }
}
