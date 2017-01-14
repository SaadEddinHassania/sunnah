<?php

namespace App;

use App\Models\Course;
use App\Models\Role_Permission;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('F jS, Y h:i A');
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function supervisor()
    {
        return $this->hasOne(Supervisor::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'id', 'user_id');
    }

    public function is_admin()
    {
        return Auth::user()->is_admin;
    }

    public function permissions()
    {
        if (count($this->supervisor)) {
            return $this->supervisor()->role->permissions();
        }
        return null;
    }

    public function hasRole($name)
    {
        if (count($this->supervisor)) {
            return $name == $this->supervisor()->role->name;
        }

    }

    public function setRole($name)
    {
        // If user does not already have this role
        if (!$this->hasRole($name)) {
            // Look up the role and attach it to the user
            $role = Role::where('name', '=', $name)->first();
            $this->supervisor()->role()->save($role);
        }
    }

    public function deleteRole($name)
    {
        // If user has this role
        if ($this->hasRole($name)) {
            // Lookup the role and detach it from the user
            $this->supervisor()->role_id = null;
            $this->supervisor()->save();
        }
    }

    public static function isAdmin()
    {
        return Auth::user()->is_admin;
    }

    public static function getRegion()
    {
        return Supervisor::where('user_id', '=', Auth::user()->id)->first()->region_id;
    }

    public static function getRoleId($id)
    {
        return User::join('supervisors', 'users.id', 'supervisors.user_id')
            ->where('supervisors.user_id', '=', $id)
            ->select('role_id')
            ->first()
            ->role_id;
    }

    public static function hasPermission($perm_name)
    {
        if (self::isAdmin()) return true;

        return Role_Permission::join('permissions', 'permissions.id', 'roles_permissions.permission_id')
            ->where('role_id', '=', self::getRoleId(Auth::user()->id))
            ->where('func_name', '=', $perm_name)
            ->exists();
    }

    public function courses(){
        return $this->belongsToMany(Course::class);
    }

    public function students()
    {
        return $this->hasManyThrough('App\Student', 'App\User');
    }
}
