<?php

namespace App\Providers;

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
        "App\Models\Post" => "App\Policies\PostPolicy",
        "App\Models\User::class"=>"App\Policies\UserPolicy::class",
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


        Gate::define("admin", function($user){
            foreach($user->roles as $role){
                if($role->name === "admin"){
                    return true;
                }
            }
            return false;
        });
    }
}
