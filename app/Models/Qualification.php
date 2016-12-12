<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{

    public $timestamps = false;


    public static function getName($id)
    {
        return Qualification::where('id', '=', $id)
            ->select('name')
            ->first()
            ->name;
    }

    public static function toDropDown()
    {
        return Qualification::all()
            ->pluck('name', 'id');
    }
}
