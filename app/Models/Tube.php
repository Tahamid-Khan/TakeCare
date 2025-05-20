<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReceptionModel;
use App\Models\PathologyModel;

class Tube extends Model
{
    use HasFactory;

    public function patient()
    {
        return $this->belongsTo(ReceptionModel::class,'patient_id');
    }
    public function Pathology()
    {
        return $this->belongsTo(PathologyModel::class,'pathologys_id');
    }
}
