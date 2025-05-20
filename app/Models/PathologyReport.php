<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PathologyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'pathology_id',
        'test_results',
        'remarks',
        'file',
    ];
}
