<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class CheckUser
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
        if (Auth::check()) {
            $check = User::where('id',Auth::user()->id)->first();
            if ($check->level == 1) {
                 return redirect()->route('dashboard.index');
            }else{
                 return redirect()->route('home.index');
            }
        }
        return $next($request);
    }
}
