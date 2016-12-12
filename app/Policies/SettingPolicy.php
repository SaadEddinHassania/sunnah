<?php

namespace App\Policies;

use App\Models\Supervisor;
use App\Models\User_Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class SettingPolicy
{
    use HandlesAuthorization;

    public function view(){
        if (User::isAdmin()) return true;

        $c = Supervisor::where('user_id', '=', Auth::user()->id)
            ->where('role_id', '=', 1)->count();

        if ($c > 0){
            return true;
        }
        return false;
    }
}
