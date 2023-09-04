<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin', fn($user) => $user->isAdmin());
        Gate::define('customer', fn($user) => $user->isCustomer());
        Gate::define('superadmin', fn($user) => $user->isSuperAdmin());
        Gate::define('user', fn($user) => $user->isUser());
    }
}
