<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RadiologyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'radiology_id',
        'test_results',
        'remarks',
        'file',
    ];

    public function radiology(): BelongsTo
    {
        return $this->belongsTo(Radiology::class);
    }

}
