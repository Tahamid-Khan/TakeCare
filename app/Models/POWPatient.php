<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POWPatient extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }
}
