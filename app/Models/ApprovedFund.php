<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApprovedFund extends Model
{
    use HasFactory;

    protected $fillable = [
        'fund_department_id',
        'amount',
        'date',
        'note'
    ];

//    department
    public function fundDepartment(): BelongsTo
    {
        return $this->belongsTo(FundDepartment::class, 'fund_department_id');
    }
}
