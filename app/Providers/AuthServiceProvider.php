<?php

namespace App\Providers;

use App\Actors;
use App\Films;
use App\Policies\UsersPolicy;
use App\Policies\FilmPolicy;
use App\Policies\ActorPolicy;
use App\Users;
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
        'App\Model' => 'App\Policies\ModelPolicy',
          Actors::class => ActorPolicy::class,
          Films::class => FilmPolicy::class,
          Users::class => UsersPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
