<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function supervisors()
    {
        return $this->hasMany(Supervisor::class);
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

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }
}
