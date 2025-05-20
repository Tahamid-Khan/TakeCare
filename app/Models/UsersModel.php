<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    public $table = 'users';

    /**
     * @var bool
     */
    public $timestamps = false;

    public function getData()
    {
        $data = $this
            ->leftjoin('registration','users.id','=','registration.user_id')
            ->where(['users.status' => 1,'users.id'=>auth()->user()->id])
            ->select(
                'registration.*',
                'users.name',
            )->first();
        //dd($data);
        return $data;
    }
}
