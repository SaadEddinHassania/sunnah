<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Role;
use App\Models\Role_Permission;
use App\Models\Student;
use App\Models\Supervisor;
use App\Policies\CoursePolicy;
use App\Policies\RolePermissionsPolicy;
use App\Policies\RolePolicy;
use App\Policies\SettingPolicy;
use App\Policies\StudentPolicy;
use App\Policies\SupervisorPolicy;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use TCG\Voyager\Models\Setting;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        'App\Model' => 'App\Policies\ModelPolicy',
        Course::class => CoursePolicy::class,
        Setting::class => SettingPolicy::class,
        Student::class => StudentPolicy::class,
        Supervisor::class => SupervisorPolicy::class,
        Role::class => RolePolicy::class,
        Role_Permission::class => RolePermissionsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $breads = array(
            ['name' => 'roles', 'admin' => true],
            ['name' => 'permissions', 'admin' => true],
            ['name' => 'specializations', 'admin' => false],
            ['name' => 'qualifications', 'admin' => false],
            ['name' => 'courses-fields', 'admin' => false]
        );

        Gate::define('roles', function () {
            return Auth::user()->isAdmin();
        });

        Gate::define('permissions', function () {
            return Auth::user()->isAdmin();
        });

        Gate::define('menus', function () {
            return Auth::user()->isAdmin();
        });

        Gate::define('users', function () {
            return Auth::user()->isAdmin();
        });

        Gate::define('database', function () {
            return Auth::user()->isAdmin();
        });

        Gate::define('specializations', function () {
            return User::hasPermission('specializations');
        });

        Gate::define('qualifications', function () {
            return User::hasPermission('qualifications');
        });

        Gate::define('courses-fields', function () {
            return User::hasPermission('courses-fields');
        });

        Gate::define('courses-types', function () {
            return User::hasPermission('courses-types');
        });

        Gate::define('regions', function () {
            return User::hasPermission('regions');
        });

        Gate::define('venues', function () {
            return User::hasPermission('venues');
        });
    }
}
