<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyAuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->can('isAdmin', Auth::user())) {
            return $next($request);
        }

        return redirect()->route('admin_login')->with('danger', "Vous n'êtes pas autorisé a accéder à cette partie !");
    }
}
