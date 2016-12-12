<?php

namespace App\Policies;

use App\Models\Course;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

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
        error_log('class:' . get_class($this). '--'. __FUNCTION__);
        if (User::isAdmin()) return true;

        $c = $user->join('supervisors', 'users.id', 'supervisors.user_id')
            ->where('supervisors.user_id', '=', $user->id)
            ->where('supervisors.region_id', '=', $course->region_id)
            ->count();

        if ($c > 0) {
            return true;
        }
        return false;
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

        $c = $user->join('supervisors', 'users.id', 'supervisors.user_id')
            ->where('supervisors.user_id', '=', $user->id)
            ->count();

        if ($c > 0) {
            return true;
        }
        return false;
    }

    public function insertUpdateData(User $user, Course $course)
    {
        if (User::isAdmin()) return true;

        $c = $user->join('supervisors', 'users.id', 'supervisors.user_id')
            ->where('supervisors.user_id', '=', $user->id)
            ->count();

        if ($c > 0) {
            return true;
        }
        return false;
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

        $c = $user->join('supervisors', 'users.id', 'supervisors.user_id')
            ->where('supervisors.user_id', '=', $user->id)
            ->where('supervisors.region_id', '=', $course->region_id)
            ->count();

        if ($c > 0) {
            return true;
        }
        return false;
    }


    public function edit(User $user, Course $course)
    {
        if (User::isAdmin()) return true;

        $c = $user->join('supervisors', 'users.id', 'supervisors.user_id')
            ->where('supervisors.user_id', '=', $user->id)
            ->where('supervisors.region_id', '=', $course->region_id)
            ->count();
        if ($c > 0) {
            return true;
        }
        return false;
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

        $c = $user->join('supervisors', 'users.id', 'supervisors.user_id')
            ->where('supervisors.user_id', '=', $user->id)
            ->where('supervisors.region_id', '=', $course->region_id)
            ->count();
        if ($c > 0) {
            return true;
        }
        return false;
    }

}
