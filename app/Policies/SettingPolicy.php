<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;

    public function view()
    {
        if (User::isAdmin()) return true;
    }

    public function index(User $user){
        if (User::isAdmin()) return true;
    }
}
