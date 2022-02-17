<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class CheckLoginAdmin
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
        if (Auth::guest()) {
            return redirect()->route('signin.index');
        }else{
            $check = User::where('id',Auth::user()->id)->first();
            if ($check->level != 2) {
                return $next($request);
            }else{
                // return $next($request);
                return redirect()->back();
            }
        }
    }
}
