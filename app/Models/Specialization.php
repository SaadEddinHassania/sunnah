<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{

    public $timestamps = false;
    
    public static function getName($id)
    {
        return Specialization::where('id', '=', $id)
            ->select('name')
            ->first()
            ->name;
    }

    public static function toDropDown()
    {
        return Specialization::all()
            ->pluck('name', 'id');
    }
}
