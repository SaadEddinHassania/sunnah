<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'supervisors';

    public static function getName($id)
    {
        return Teacher::join('users', 'supervisors.user_id', 'users.id')
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

    public function courses(){
        return $this->hasMany(Course::class, 'user_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
