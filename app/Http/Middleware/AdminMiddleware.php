<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Prologue\Alerts\Facades\Alert;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::check()) {
            if (!Auth::guard($guard)->user()->hasRole('super_admin')) {
                Auth::logout();
                Alert::error("Permission Denied.")->flash();
                return redirect('/');
            }
        } else {
            if ($request->path() != config('backpack.base.route_prefix', 'admin') . '/login') {
                Alert::error("Permission Denied.")->flash();
                return redirect(config('backpack.base.route_prefix', 'admin') . '/login');
            }
        }
        return $next($request);
    }
}
