<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCsrfTokenForDebug
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('post') || $request->isMethod('put') || $request->isMethod('delete')) {
            if (!hash_equals($request->session()->token(), $request->input('_token'))) {
                abort(419, 'CSRF Token mismatch detected');
            }
        }
        return $next($request);
    }
}
