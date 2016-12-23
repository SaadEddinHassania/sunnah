<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Course_Type;
use App\Models\Permission;
use App\Models\Role_Permission;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use TCG\Voyager\Models\Role;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the course.
     *
     * @param  \App\User $user
     * @param \App\Course|Course $course
     * @return mixed
     */

    public function view(User $user, Course $course)
    {
        if (User::isAdmin()) return true;

        $global = Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId(__FUNCTION__, class_basename(__CLASS__)))
            ->select('global')
            ->first();

        if ($global === null) {
            if ($this->view_concerning($user)) {
                return $course->supervisor_id == $user->id || $course->teacher_id == $user->id;
            }
            return false;
        } elseif ($global) {
            return true;
        } else {
            return $user->join('supervisors', 'users.id', 'supervisors.user_id')
                ->where('supervisors.user_id', '=', $user->id)
                ->where('supervisors.region_id', '=', $course->region_id)
                ->exists();
        }
    }

    /**
     * Determine whether the user can create courses.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if (User::isAdmin()) return true;

        return Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId(__FUNCTION__, class_basename(__CLASS__)))
            ->exists() || $this->create_concerning($user);
    }

    /**
     * Determine whether the user can update the course.
     *
     * @param  \App\User $user
     * @param \App\Models\Course $course
     * @return mixed
     */
    public function update(User $user, Course $course)
    {
        if (User::isAdmin()) return true;

        $global = Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId(__FUNCTION__, class_basename(__CLASS__)))
            ->select('global')
            ->first();

        if ($global === null) {
            if ($this->update_concerning($user)) {
                return $course->supervisor_id == $user->id || $course->teacher_id == $user->id;
            }
            return false;
        } elseif ($global) {
            return true;
        } else {
            return $user->join('supervisors', 'users.id', 'supervisors.user_id')
                ->where('supervisors.user_id', '=', $user->id)
                ->where('supervisors.region_id', '=', $course->region_id)
                ->exists();
        }
    }

    /**
     * Determine whether the user can delete the course.
     *
     * @param  \App\User $user
     * @param \App\Course|Course $course
     * @return mixed
     */
    public function delete(User $user, Course $course)
    {
        if (User::isAdmin()) return true;

        $global = Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId(__FUNCTION__, class_basename(__CLASS__)))
            ->select('global')
            ->first();

        if ($global === null) {
            if ($this->view_concerning($user)) {
                return $course->supervisor_id == $user->id || $course->teacher_id == $user->id;
            }
            return false;
        } elseif ($global) {
            return true;
        } else {
            return $user->join('supervisors', 'users.id', 'supervisors.user_id')
                ->where('supervisors.user_id', '=', $user->id)
                ->where('supervisors.region_id', '=', $course->region_id)
                ->exists();
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

    public function view_concerning(User $user)
    {
        if (User::isAdmin()) return true;

        return Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId(__FUNCTION__, class_basename(__CLASS__)))
            ->exists();
    }

    public function create_concerning(User $user)
    {
        if (User::isAdmin()) return true;

        return Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId(__FUNCTION__, class_basename(__CLASS__)))
            ->exists();
    }

    public function update_concerning(User $user)
    {
        if (User::isAdmin()) return true;

        return Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId(__FUNCTION__, class_basename(__CLASS__)))
            ->exists();
    }

    public function delete_concerning(User $user)
    {
        if (User::isAdmin()) return true;
        
        return Role_Permission::where('role_id', '=', User::getRoleId($user->id))
            ->where('permission_id', '=', Permission::getId(__FUNCTION__, class_basename(__CLASS__)))
            ->exists();
    }

}
