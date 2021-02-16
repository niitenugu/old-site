<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->isAdminGroup();

        $this->isOwner();

        $this->isSuperAdmin();

        $this->isStaff();
    }

    public function isAdminGroup()
    {
        Gate::define('isAdminGroup', function(User $user){
            if (array_key_exists($user->role, User::ADMIN_GROUP)) {
                return true;
            }
            return false;
        });
    }

    public function isOwner()
    {
        Gate::define('isOwner', function(User $user){
            return $user->role == 'owner';
        });
    }

    public function isSuperAdmin()
    {
        Gate::define('isSuperAdmin', function(User $user){
            return $user->role == 'superadmin';
        });
    }

    public function isStaff()
    {
        Gate::define('isStaff', function(User $user){
            return $user->role == 'staff';
        });
    }
}
