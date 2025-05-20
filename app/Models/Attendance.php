<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'check_in',
        'check_out',
        'total_hours',
        'date',
        'status',
    ];
    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'date' => 'datetime',
        'total_hours' => 'datetime'
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
