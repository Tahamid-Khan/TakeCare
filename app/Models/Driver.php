<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ambulance()
    {
        return $this->hasOne(Ambulance::class);
    }

//    rides

    public function rides()
    {
        return $this->hasMany(Ride::class);
    }


}
