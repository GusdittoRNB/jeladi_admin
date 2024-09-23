<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();
        //Passport::routes();

        $gate->define('be_super_admin', function ($user) {
            return 'super_admin' == $user->role;
        });

        $gate->define('be_admin', function ($user) {
            return 'admin' == $user->role;
        });

        $gate->define('be_user', function ($user) {
            return 'user' == $user->role;
        });
    }
}
