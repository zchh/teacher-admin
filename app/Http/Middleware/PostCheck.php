<?php namespace App\Http\Middleware;
use  Illuminate\Support\Facades\Request;
use Closure;
use Illuminate\Support\Facades\Validator;
class PostCheck {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request,  Closure $next)
	{
	   $postData = Request::all();
           foreach($postData as $key => $data )
           {
               if(($tmp = config("post_check.".$key))!=NULL)
               {
                   $checkData[$key] = $data;
                   $checkRule[$key] = $tmp["rule"];
               }
           }
           //dump($checkData);dump($checkRule);
           $validator = Validator::make($checkData, $checkRule);
           if($validator -> passes())
           {
               
           }
           else
           {
               $errorData = $validator->failed();
               $defaultMessage= $validator->messages();
               
               dump($errorData);
               
               
                foreach($errorData as $key => $data)
               {
                  if( ($tmp=config("post_check.".$key.".message")) != NULL)
                  {
                      dump($tmp);
                  }
                  else 
                  {
                     foreach ($defaultMessage->$key as $message)
                    {
                        dump($message);
                    }

                      
                  }
               }
             
              
           }
           
           exit();
	    
               
              /* return $next($request);
               
	
	    
	        return redirect("/admin_login");*/
	    
		
	}

}
