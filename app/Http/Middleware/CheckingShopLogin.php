<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class CheckingShopLogin

{
    public function handle(Request $request, Closure $next)
    {
        if (EMPTY(session()->has('shop_id'))) {
            return redirect()->route('login_shop');
        }
        return $next($request);
    }
}
