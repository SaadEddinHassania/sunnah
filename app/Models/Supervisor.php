<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Role;

class Supervisor extends Model
{
    protected $table = 'supervisors';

    public $timestamps = false;

    public static function getName($id)
    {
        return Supervisor::join('users', 'supervisors.user_id', 'users.id')
            ->where('users.id', '=', $id)
            ->where('supervisors.role_id', '!=', Role::where('name', 'teacher')->first()->id)
            ->select('users.name')
            ->first()
            ->name;
    }

    public static function toDropDown()
    {
        return Supervisor::join('users', 'supervisors.user_id', 'users.id')
            ->where('supervisors.role_id', '!=', Role::where('name', 'teacher')->first()->id)
            ->pluck('users.name', 'users.id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    public function courses(){
        return $this->hasMany(Course::class, 'user_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
