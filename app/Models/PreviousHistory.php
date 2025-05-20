<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousHistory extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'doctor_name', 'condition', 'treatment', 'date'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
