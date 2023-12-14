<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckingUserLogin
{
   
    public function handle(Request $request, Closure $next)
    {
        if (EMPTY(session()->has('user_id'))) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
