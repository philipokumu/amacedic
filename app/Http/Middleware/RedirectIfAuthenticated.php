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
        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect('/admin');
                }
            break;

            case 'editor':
                if (Auth::guard($guard)->check()) {
                    return redirect('/editor');
                }
            break;

            case 'writer':
                if (Auth::guard($guard)->check()) {
                    return redirect('/writer');
                }
            break;

            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/home');
                }
            break;
        }
        // if ($guard == "admin" && Auth::guard($guard)->check()) {
        //     return redirect('/admin');
        // }

        // if ($guard == "editor" && Auth::guard($guard)->check()) {
        //     return redirect('/editor');
        // }

        // if ($guard == "writer" && Auth::guard($guard)->check()) {
        //     return redirect('/writer');
        // }
        
        // if (Auth::guard($guard)->check()) {
        //     return redirect('/home');
        // }

        return $next($request);
    }
}
