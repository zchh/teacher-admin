<?php namespace App\Http\Middleware;

use Closure;

class LoginUserCheck {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
	    if(session("user.user_status")==true)
	    {
               
               return $next($request);
               
	        
	    }
	    else
	    {
	        return redirect("/user_login");
	    }
		
	}

}
