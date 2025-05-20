<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRModel extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    public $table = 'employees';

    /**
     * @var bool
     */
    public $timestamps = false;
}
