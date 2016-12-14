<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'supervisors';

    public static function getName($id)
    {
        return Teacher::join('users', 'supervisors.user_id', 'users.id')
            ->where('supervisors.role_id', '=', 3)
            ->where('users.id', '=', $id)
            ->select('users.name')
            ->first()
            ->name;
    }

    public static function toDropDown()
    {
        return Supervisor::join('users', 'supervisors.user_id', 'users.id')
            ->where('supervisors.role_id', '=', 3)
            ->pluck('users.name', 'users.id');
    }
}
