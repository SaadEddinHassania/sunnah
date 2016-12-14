<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function getName($id)
    {
        return Role::where('id', '=', $id)
            ->select('display_name')
            ->first()
            ->display_name;
    }

    public static function toDropDown()
    {
        return Role::pluck('display_name', 'id');
    }
}
