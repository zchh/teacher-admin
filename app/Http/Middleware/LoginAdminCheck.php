<?php namespace App\Http\Middleware;

use Closure;

class LoginAdminCheck {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
	    if(session("admin.admin_status")==true)
	    {
               
               return $next($request);
               
	        
	    }
	    else
	    {
	        return redirect("/admin_login");
	    }
		
	}

}
