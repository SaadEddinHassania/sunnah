<?php

namespace App;

use App\Models\Supervisor;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    public function supervisor(){
        return $this->hasOne(Supervisor::class);
    }

    public function is_admin() {
        if (count($this->supervisor))
        {
            return true;
        }
        return false;
    }

    public function permissions()
    {
        if (count($this->supervisor))
        {
            return $this->supervisor()->role->permissions();
        }
        return null;
    }

    public function hasRole($name)
    {
        return $name == $this->supervisor()->role->name;
    }

    public function hasPermission($name)
    {
        return in_array($name, Arr::pluck($this->supervisor()->role()->permissions->toArray(), 'name'));
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
}
