<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureActivation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if ( Auth::check() && $request->user()->isActivated() )
        {
            if($request->user()->isWelcomed() ){
                return $next($request);
            }else{
                return redirect('welcomepack')->with('error','User has not Selected Welcome Pack');
            }
        }



        return redirect('inactivelock')->with('error','User has not been activated');

    }
}
