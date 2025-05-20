<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;

    const userTypes = ['receptionist', 'duty_doctor', 'nurse', 'pathologist', 'opd_doctor', 'emergency_doctor', 'icu_doctor', 'pow_doctor', 'ot_doctor', 'store', 'accountant', 'hr', 'ambulance', 'employee','death_register', 'radiology', 'admin', 'cbd', 'cmo'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'image',
        'status',
        'is_assigned',
        'department_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function nurse(): HasOne
    {
        return $this->hasOne(Nurse::class);
    }

    public function doctor(): HasOne
    {
        return $this->hasOne(Doctor::class);
    }
}
