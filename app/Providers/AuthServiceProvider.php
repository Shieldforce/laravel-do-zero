<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Contracts\Auth\Access\Gate;
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
    public function boot(Gate $gate)
    {
        $this->registerPolicies();
        try
        {
            $gate->before(function (User $user){
                if($user->hasAnyRoles("Administrator"))
                {
                    return true;
                }
            });
            $permissions = Permission::with("roles")->get();
            foreach ($permissions as $permission)
            {
                $gate->define($permission->name, function (User $user) use ($permission){
                    return $user->hasPermission($permission);
                });
            }
        }
        catch (\Exception $exception){}
    }
}
