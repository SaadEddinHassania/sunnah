<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    protected $table = 'courses_types';

    public static function getName($id)
    {
        return CourseType::where('id', '=', $id)
            ->select('name')
            ->first()
            ->name;
    }

    public static function toDropDown()
    {
        return CourseType::pluck('name', 'id');
    }
}
