<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'pharmaceutical_name',
        'brand_name',
        'generic_name',
        'strength',
        'dosage_description',
        'price',
        'use_for',
        'status',
    ];
}
