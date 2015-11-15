<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
            $data = config("my_config.special_page");
            foreach($data as $v)
            {
                if($_SERVER["REQUEST_URI"] == $v)
                {
                    
                     return $next($request);
                }
            }
            //echo $_SERVER["REQUEST_URI"] ;
            
            return parent::handle($request, $next);
	}

}
