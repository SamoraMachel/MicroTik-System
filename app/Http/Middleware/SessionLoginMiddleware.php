<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class SessionLoginMiddleware
{
    /**
     * Handle an incoming request. Check if an admin has logged in to router and use that connection
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
          if($request->session()->exists('router_session')){
              return $next($request);
          }else{
              return redirect('home');
          }  
        }
        else{
            return redirect('/login');
        }
        
        
    }
}
