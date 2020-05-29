<?php

namespace App\Http\Middleware;

use Closure;

class IndexLogin
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
        $user=session('user');
        if(!$user){
            return redirect('/login');
        }
        return $next($request);
    }
}
