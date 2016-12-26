<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\Role_Permission;
use App\User;
use App\Models\Supervisor;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupervisorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the supervisor.
     *
     * @param  \App\User $user
     * @param  \App\Supervisor $supervisor
     * @return mixed
     */
    public function view(User $user, Supervisor $supervisor)
    {
        if (User::isAdmin()) return true;

        $global = Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId(__FUNCTION__, class_basename(__CLASS__)))
            ->select('global')
            ->first();

        if ($global === null) {
            return false;
        } elseif ($global) {
            return true;
        } else {
            return $user->join('supervisors', 'users.id', 'supervisors.user_id')
                ->where('supervisors.user_id', '=', $user->id)
                ->where('supervisors.region_id', '=', $supervisor->region_id)
                ->exists();
        }
    }

    public function view_teacher(User $user, Supervisor $supervisor)
    {
        if (User::isAdmin()) return true;

        $global = Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId(__FUNCTION__, class_basename(__CLASS__)))
            ->select('global')
            ->first();

        if ($global === null) {
            return false;
        } elseif ($global) {
            return true;
        } else {
            return $user->join('supervisors', 'users.id', 'supervisors.user_id')
                ->where('supervisors.user_id', '=', $user->id)
                ->where('supervisors.region_id', '=', $supervisor->region_id)
                ->exists() && $supervisor->role_id == 3;
        }
    }

    /**
     * Determine whether the user can create supervisors.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if (User::isAdmin()) return true;

        return Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId(__FUNCTION__, class_basename(__CLASS__)))
            ->exists();
    }

    public function create_teacher(User $user)
    {
        if (User::isAdmin()) return true;

        return Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId(__FUNCTION__, class_basename(__CLASS__)))
            ->exists();
    }

    /**
     * Determine whether the user can update the supervisor.
     *
     * @param  \App\User $user
     * @param  \App\Supervisor $supervisor
     * @return mixed
     */
    public function update(User $user, Supervisor $supervisor)
    {
        if (User::isAdmin()) return true;

        $global = Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId(__FUNCTION__, class_basename(__CLASS__)))
            ->select('global')
            ->first();

        if ($global === null) {
            return false;
        } elseif ($global) {
            return true;
        } else {
            return $user->join('supervisors', 'users.id', 'supervisors.user_id')
                ->where('supervisors.user_id', '=', $user->id)
                ->where('supervisors.region_id', '=', $supervisor->region_id)
                ->exists() && $supervisor->role_id == 3;
        }
    }

    public function update_teacher(User $user, Supervisor $supervisor)
    {
        if (User::isAdmin()) return true;

        $global = Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId(__FUNCTION__, class_basename(__CLASS__)))
            ->select('global')
            ->first();

        if ($global === null) {
            return false;
        } elseif ($global) {
            return true;
        } else {
            return $user->join('supervisors', 'users.id', 'supervisors.user_id')
                ->where('supervisors.user_id', '=', $user->id)
                ->where('supervisors.region_id', '=', $supervisor->region_id)
                ->exists() && $supervisor->role_id == 3;
        }
    }

    /**
     * Determine whether the user can delete the supervisor.
     *
     * @param  \App\User $user
     * @param  \App\Supervisor $supervisor
     * @return mixed
     */
    public function delete(User $user, Supervisor $supervisor)
    {
        if (User::isAdmin()) return true;

        $global = Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId(__FUNCTION__, class_basename(__CLASS__)))
            ->select('global')
            ->first();

        if ($global === null) {
            return false;
        } elseif ($global) {
            return true;
        } else {
            return $user->join('supervisors', 'users.id', 'supervisors.user_id')
                ->where('supervisors.user_id', '=', $user->id)
                ->where('supervisors.region_id', '=', $supervisor->region_id)
                ->exists();
        }
    }

    public function delete_teacher(User $user, Supervisor $supervisor)
    {
        if (User::isAdmin()) return true;

        $global = Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId(__FUNCTION__, class_basename(__CLASS__)))
            ->select('global')
            ->first();

        if ($global === null) {
            return false;
        } elseif ($global) {
            return true;
        } else {
            return $user->join('supervisors', 'users.id', 'supervisors.user_id')
                ->where('supervisors.user_id', '=', $user->id)
                ->where('supervisors.region_id', '=', $supervisor->region_id)
                ->exists() && $supervisor->role_id == 3;
        }
    }

    public function create_global(User $user)
    {
        if (User::isAdmin()) return true;

        return Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId('create', class_basename(__CLASS__)))
            ->where('global', '=', 1)
            ->exists();
    }

    public function view_global(User $user)
    {
        if (User::isAdmin()) return true;

        return Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId('view', class_basename(__CLASS__)))
            ->where('global', '=', 1)
            ->exists();
    }

    public function view_local(User $user)
    {
        return Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId('view', class_basename(__CLASS__)))
            ->where('global', '=', 0)
            ->exists();
    }

    public function create_teacher_global(User $user)
    {
        if (User::isAdmin()) return true;

        return Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId('create_teacher', class_basename(__CLASS__)))
            ->where('global', '=', 1)
            ->exists();
    }

    public function view_teacher_global(User $user)
    {
        if (User::isAdmin()) return true;

        return Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId('view_teacher', class_basename(__CLASS__)))
            ->where('global', '=', 1)
            ->exists();
    }

    public function view_teacher_local(User $user)
    {
        return Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId('view_teacher', class_basename(__CLASS__)))
            ->where('global', '=', 0)
            ->exists();
    }

    public function update_role(User $user)
    {
        if (User::isAdmin()) return true;

        return Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId(__FUNCTION__, class_basename(__CLASS__)))
            ->exists();
    }

    public function index(User $user){
        if (User::isAdmin()) return true;

        return Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId('view', class_basename(__CLASS__)))
            ->exists();
    }

    public function index_teacher(User $user){
        if (User::isAdmin()) return true;

        return Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId('view_teacher', class_basename(__CLASS__)))
            ->exists();
    }
}
