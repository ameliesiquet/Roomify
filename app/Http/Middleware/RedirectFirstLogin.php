<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RedirectFirstLogin
{

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && session()->has('new_registration')) {
            session()->forget('new_registration');
            return redirect()->route('welcome');
        }

        return $next($request);
    }

}
