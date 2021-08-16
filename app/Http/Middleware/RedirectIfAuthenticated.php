<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && auth()->user()->role == 'admin') {
            return redirect('/back/dashboard');
        } elseif(auth()->check() && auth()->user()->role == 'merchant') {
            return redirect('/merchant/panel/editprofile');
        }
         else if(auth()->check() && auth()->user()->role == 'customer') {
            return redirect('/');
        }
        return $next($request);
    }

}