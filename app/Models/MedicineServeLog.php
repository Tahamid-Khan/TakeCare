<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicineServeLog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['patient_id', 'date', 'status', 'schedule'];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
