<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nurse extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'nurse_id',
        'type',
        'department_id',
        'position',
        'qualification',
        'employee_status',
        'contact_number',
        'address',
        'user_id',
        'ward_id',
    ];

//    boot generate nurse id with department and type
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($nurse) {
            $nurse->nurse_id = $nurse->department_id ."-". $nurse->type ."-". $nurse->user_id;
        });
    }
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
