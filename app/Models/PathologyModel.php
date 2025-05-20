<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReceptionModel;
use App\Models\Doctor;

class PathologyModel extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    public $table = 'pathologys';

    /**
     * @var bool
     */
    public $timestamps = false;

    public function patient()
    {
        return $this->belongsTo(ReceptionModel::class,'patient_id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
}
