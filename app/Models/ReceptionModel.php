<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;
use App\Models\CavinWard;

class ReceptionModel extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    public $table = 'patients';

    /**
     * @var bool
     */
    public $timestamps = false;




}
