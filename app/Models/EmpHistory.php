<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpHistory extends Model
{
//    use HasFactory;
    protected $table = 'emp_histories';
    protected $fillable = [
        'employee_id_id',
        'history',
        'document',
    ];
}
