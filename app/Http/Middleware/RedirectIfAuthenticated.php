<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            if ($user->Clave_Rol == 1) {
                return redirect('/Admin/Compania');
            } elseif ($user->Clave_Rol == 2) {
                return redirect('/Admin/Areas');
            } elseif ($user->Clave_Rol == 3) {
                return redirect('/Admin/Proyectos');
            } elseif ($user->Clave_Rol == 4) {
                return redirect('/Admin/Proyectos');
            } else {
                Auth::logout();
                return redirect('/login');
            }
        }

        return $next($request);
    }
}
