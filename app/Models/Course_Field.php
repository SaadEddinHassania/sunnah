<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course_Field extends Model
{
    protected $table = 'courses_fields';

    public static function getName($id)
    {
        return Course_Field::where('id', '=', $id)
            ->select('name')
            ->first()
            ->name;
    }

    public static function toDropDown()
    {
        return Course_Field::pluck('name', 'id');
    }
}
