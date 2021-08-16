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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* define a admin role */
        Gate::define('isAdmin', function($user) {
            return $user->role == 'admin';
        });

        /* define a merchant role */
        Gate::define('isMerchant', function($user) {
            return $user->role == 'merchant';
        });


        /* define a customer role */
        Gate::define('isCustomer', function($user) {
            return $user->role == 'customer';
        });
    }
}
