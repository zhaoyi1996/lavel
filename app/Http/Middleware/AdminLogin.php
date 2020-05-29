<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
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
        $Admin=session('admin');
        // dd($Admin);
        if(!$Admin){
            $admin_cookie=request()->cookie('admin');
            
            if($admin_cookie){
                session('admin',unserialize($admin_cookie));
            }else{
                return redirect('/login');
            }
        }
        return $next($request);
    }
}
