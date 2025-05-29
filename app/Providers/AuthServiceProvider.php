<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin', fn(User $user) => $user->role_id == '1');
        Gate::define('petugas', fn(User $user) => $user->role_id == '2');
        Gate::define('anggota', fn(User $user) => $user->role_id == '3');

        Gate::define('admin-dan-petugas', fn($user) => in_array($user->role_id, ['1', '2']));
    }
}
