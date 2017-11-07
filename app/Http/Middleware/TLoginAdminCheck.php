<?php namespace App\Http\Middleware;

use Closure;

class TLoginAdminCheck {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(false == empty(session("admin"))) {
            return $next($request);
        } else {
            return redirect("/t_admin_login");
        }

    }

}
