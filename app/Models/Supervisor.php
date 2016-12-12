<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $table = 'supervisors';

    public $timestamps = false;

    public static function getName($id)
    {
        return Supervisor::join('users', 'supervisors.user_id', 'users.id')
            ->where('users.id', '=', $id)
            ->select('users.name')
            ->first()
            ->name;
    }

    public static function toDropDown()
    {
        return Supervisor::join('users', 'supervisors.user_id', 'users.id')
            ->pluck('users.name', 'users.id');
    }
}
