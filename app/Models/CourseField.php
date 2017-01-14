<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseField extends Model
{
    protected $table = 'courses_fields';

    public static function getName($id)
    {
        return CourseField::where('id', '=', $id)
            ->select('name')
            ->first()
            ->name;
    }

    public static function toDropDown()
    {
        return CourseField::pluck('name', 'id');
    }
}
