<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    public static function getName($id)
    {
        return Student::join('users', 'students.user_id', 'users.id')
            ->where('users.id', '=', $id)
            ->select('users.name')
            ->first()
            ->name;
    }
}
