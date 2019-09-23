<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JOSE_JWT;

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

        Gate::define('admin', function (array $user) {
            // dump($user);
            return in_array('admin', $user['cognito:groups']);
        });

        Gate::define('admin-req', function (array $user, Request $request) {
            // dump($user);
            // dump($request->all());
            return in_array('admin', $user['cognito:groups']);
        });

        Gate::define('manager', function (array $user) {
            // dump($user);
            return in_array('manager', $user['cognito:groups']);
        });

        Auth::viaRequest('cognito-jwt', function ($request) {
            $jwt = $request->bearerToken();
            if ($jwt) {
                $decoded = JOSE_JWT::decode($jwt);

                return $decoded->claims;
            }
            return null;
        });
    }
}
