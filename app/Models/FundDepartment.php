<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class FundDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fund_id',
        'balance',
        'slug',
    ];

//    boot to generate slug from name
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($department) {
            $department->slug = Str::slug($department->name);
        });
    }
    public function fund(): BelongsTo
    {
        return $this->belongsTo(Fund::class);
    }

    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class, 'department_id');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'department_id');
    }
}
