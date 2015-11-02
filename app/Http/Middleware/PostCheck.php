<?php namespace App\Http\Middleware;
use  Illuminate\Support\Facades\Request;
use Closure;
use Illuminate\Support\Facades\Validator;
use GirdPlugins\Base\BaseFunc;
class PostCheck {

        public function __construct(BaseFunc $baseFunc) {
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
           
	   $postData = Request::all();
          
           $checkData=[];
           foreach($postData as $key => $data )
           {
               if(($tmp = config("post_check.".$key))!=NULL)
               {
                   $checkData[$key] = $data;
                   $checkRule[$key] = $tmp["rule"];
               }
           }
           //如果没有符合的验证规则，就跳过
           if($checkData==NULL)
           {
               return $next($request);
           }
           
           
           //dump($checkData);dump($checkRule);
           $validator = Validator::make($checkData, $checkRule);
           if($validator -> passes())
           {
               return $next($request);
           }
           else
           {
               $errorData = $validator->failed();
               $defaultMessage= $validator->messages();
               
               
               //dump($errorData);
               
               
                foreach($errorData as $key => $data)
               {
                  if( ($tmp=config("post_check.".$key.".message")) != NULL)
                  {
                      $this->baseFunc->setRedirectMessage(false,$tmp , NULL, NULL);
                      return redirect()->back();
                  }
                  else 
                  {
                      $m="";
                     foreach ($defaultMessage->$key as $message)
                    {
                       $m.=$message."<br/>";
                    }
                    $this->baseFunc->setRedirectMessage(false,$m , NULL, NULL);
                    return redirect()->back();
                      
                  }
               }
             
              
           }
           
           exit();
	    
               
              /* return $next($request);
               
	
	    
	        return redirect("/admin_login");*/
	    
		
	}

}