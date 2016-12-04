<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'supervisors';

    public static function getName($id)
    {
        return Teacher::join('users', 'supervisors.user_id', 'users.id')
            ->where('supervisors.type', '=', 'teacher')
            ->where('users.id', '=', $id)
            ->select('users.name')
            ->first()
            ->name;
    }

    public static function toDropDown()
    {
        return Supervisor::join('users', 'supervisors.user_id', 'users.id')
            ->where('supervisors.type', '=', 'teacher')
            ->pluck('users.name', 'users.id');
    }
}
