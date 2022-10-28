<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Support\Facades\App;

class AuthenticateWithBasicAuthInProduction extends AuthenticateWithBasicAuth
{
    public function handle(
        $request,
        Closure $next,
        $guard = null,
        $field = null
    ) {
        if (App::isLocal()) {
            return $next($request);
        }

        return parent::handle($request, $next, $guard, $field);
    }
}
