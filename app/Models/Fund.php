<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fund extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'balance',
    ];

    public function fundDepartment(): HasMany
    {
        return $this->hasMany(FundDepartment::class);
    }
}
