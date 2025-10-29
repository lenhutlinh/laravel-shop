<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckingUserLogin
{
   
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('user_id') || empty(session('user_id'))) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để tiếp tục');
        }
        return $next($request);
    }
}
