<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        //Provjera da li je je user autentifikovan/prijavljen i da li ispunjava uslove isAdmin funckcije
        if (Auth::check()){
            if (Auth::user()->isAdmin()){
                return $next($request);
            }
        }
        return redirect('/');
    }
}
