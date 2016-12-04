<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $table = 'venues';

    public static function getName($id)
    {
        return Venue::where('id', '=', $id)
            ->select('name')
            ->first()
            ->name;
    }

    public static function toDropDown()
    {
        return Venue::pluck('name', 'id');
    }
}
