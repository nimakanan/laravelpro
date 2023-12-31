<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class=>UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

       Gate::define("edit-user",function($user,$CurrentUserId){
return $user->id===$CurrentUserId->id;
       });
Gate::before(function($user){

    if ($user->is_superuser()) {
       return true;
    }
});
foreach(Permission::all() as $permission){
    Gate::define($permission->name,function($user) use($permission){
return $user->haspermission($permission);
    });
// }
    }
}
}