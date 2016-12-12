<?php

namespace App\Policies;

use App\User;
use App\Models\Supervisor;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupervisorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the supervisor.
     *
     * @param  \App\User  $user
     * @param  \App\Supervisor  $supervisor
     * @return mixed
     */
    public function view(User $user, Supervisor $supervisor)
    {
        if (User::isAdmin()) return true;

        $c = $user->join('supervisors', 'users.id', 'supervisors.user_id')
            ->where('supervisors.user_id', '=', $user->id)
            ->where('supervisors.region_id', '=', $supervisor->region_id)
            ->count();


        error_log('count=: '. $c);
        if ($c > 0) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create supervisors.
     *
     * @param  \App\User  $user
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

    public function insertUpdateData(User $user, Supervisor $supervisor)
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
     * Determine whether the user can update the supervisor.
     *
     * @param  \App\User  $user
     * @param  \App\Supervisor  $supervisor
     * @return mixed
     */
    public function update(User $user, Supervisor $supervisor)
    {
        if (User::isAdmin()) return true;

        $c = $user->join('supervisors', 'users.id', 'supervisors.user_id')
            ->where('supervisors.user_id', '=', $user->id)
            ->where('supervisors.region_id', '=', $supervisor->region_id)
            ->count();

        if ($c > 0) {
            return true;
        }
        return false;
    }

    public function edit(User $user, Supervisor $supervisor){
        if (User::isAdmin()) return true;

        $c = $user->join('supervisors', 'users.id', 'supervisors.user_id')
            ->where('supervisors.user_id', '=', $user->id)
            ->where('supervisors.region_id', '=', $supervisor->region_id)
            ->count();

        if ($c > 0) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the supervisor.
     *
     * @param  \App\User  $user
     * @param  \App\Supervisor  $supervisor
     * @return mixed
     */
    public function delete(User $user, Supervisor $supervisor)
    {
        if (User::isAdmin()) return true;

        $c = $user->join('supervisors', 'users.id', 'supervisors.user_id')
            ->where('supervisors.user_id', '=', $user->id)
            ->where('supervisors.region_id', '=', $supervisor->region_id)
            ->count();

        if ($c > 0) {
            return true;
        }
        return false;
    }
}
