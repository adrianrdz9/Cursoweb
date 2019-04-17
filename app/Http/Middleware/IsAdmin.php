<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if(Auth::user()->account_number == '317114270'){
                return $next($request);
            }else{
                return redirect('/'.Auth::user()->account_number);
                return redirect('/');
            }
        }else{
            return redirect()->route('login');
        }

    }
}
