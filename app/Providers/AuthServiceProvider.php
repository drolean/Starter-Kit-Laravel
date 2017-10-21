<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is-admin', function ($user) {
            if ($user->is_admin && $user->id == $user->Companie->user_id || $user->is_super) {
                return true;
            }
        });

        Gate::define('is-super', function ($user) {
            if ($user->is_super) {
                return true;
            }
        });

        foreach ($this->getPermissions() as $permission) {
            Gate::define($permission->name, function ($user) use ($permission) {
                if ($permission->visible) {
                    return true;
                }

                if ($user->is_super) {
                    return true;
                }

                if ($user->is_admin) {
                    return true;
                }

                return $user->hasPermission($permission);
            });
        }
    }

    protected function getPermissions()
    {
        try {
            return Cache::rememberForever('Permissions', function () {
                return Permission::with('roles')->get();
            });
        } catch (\Exception $e) {
            return [];
        }
    }
}
