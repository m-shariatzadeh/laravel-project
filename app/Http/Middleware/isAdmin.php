<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next /*, $role*/)
    {
        if (Auth::check())
        {
            $user = Auth::user();
//            if ($user->isAdmin($role))
            if ($user->isAdmin())
            {
                return $next($request);
            }
            else
            {
                return redirect()->route('home');
            }
        }
        else
        {
            return redirect()->route('login');
        }
    }
}
