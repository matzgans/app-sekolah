<?php

namespace App\Providers;

use App\Models\ProfileSekolah;
use App\Models\User;
use App\Policies\PermissionPolicy;
use App\Policies\ProfileSekolahPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Permission::class, PermissionPolicy::class);
        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(ProfileSekolah::class, ProfileSekolahPolicy::class);

        View::composer('landing.template.index', function ($view) {
            $profileSekolah = ProfileSekolah::first();
            $view->with('profileSekolah', $profileSekolah);
        });
    }
}
