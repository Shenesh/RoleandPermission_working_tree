<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy', //this is just a cmmoen name for the policy
         'App\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function ($user) {
            return $user->roles->first()->slug == 'admin';
        });

        Gate::define('isManager', function ($user) {
           return $user->roles->first()->slug == 'manager';
        });

        Gate::define('isEditor', function ($user) {
           return $user->roles->first()->slug == 'editor';
        });

    }
}
