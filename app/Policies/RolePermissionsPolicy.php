<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\Role_Permission;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePermissionsPolicy
{
    use HandlesAuthorization;


    public function roles_permissions(User $user)
    {
        if (User::isAdmin()) return true;

        return Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId(__FUNCTION__, class_basename(__CLASS__)))
            ->exists();
    }

    public function index(User $user)
    {
        if (User::isAdmin()) return true;

        return Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId('roles_permissions', class_basename(__CLASS__)))
            ->exists();
    }
}
