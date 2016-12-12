<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Supervisor;
use App\Policies\CoursePolicy;
use App\Policies\SettingPolicy;
use App\Policies\StudentPolicy;
use App\Policies\SupervisorPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
