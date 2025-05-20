<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'sick_leave',
        'casual_leave',
        'marital_leave',
        'total_leave',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
