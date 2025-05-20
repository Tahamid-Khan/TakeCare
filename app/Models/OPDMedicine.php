<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OPDMedicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'opd_prescription_id',
        'name',
        'dose',
        'schedule',
        'taking_time',
        'duration',
        'store_type',
    ];
}
