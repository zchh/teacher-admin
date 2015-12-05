<?php namespace App\Http\Middleware;

use Closure;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;

class LoginUserCheck {
    
        public function __construct(BaseFunc $baseFunc) 
        {
            $this->baseFunc = $baseFunc;
        }

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
	    /*if(session("user.user_status")==true)
	    {
               
               return $next($request);    
	    }
	    else
	    {
                
                if (Request::isMethod('post'))
                {
                    return $this->baseFunc->setRedirectMessage(false, "本操作需要登录", NULL,"/user_login");
                }
                else
                {
                    $redirectData["status"] = true;
                    $redirectData["url"] = Request::url();
                    session(["redirect"=>$redirectData]);
                    return $this->baseFunc->setRedirectMessage(false, "本操作需要登录", NULL,"/user_login");
                }
               
	       
	    }*/
		
	}

}
