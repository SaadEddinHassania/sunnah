<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course_Type extends Model
{
    protected $table = 'courses_types';

    public static function getName($id)
    {
        return Course_Type::where('id', '=', $id)
            ->select('name')
            ->first()
            ->name;
    }

    public static function toDropDown()
    {
        return Course_Type::pluck('name', 'id');
    }
}
