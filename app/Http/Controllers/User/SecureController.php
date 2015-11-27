<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\MailFunc;
use GirdPlugins\Base\SecureFunc;
use GirdPlugins\Base\LogFunc;
use GirdPlugins\Base\UserPowerFunc;


class SecureController extends Controller {
    
    public function __construct(SecureFunc $secureFunc,LogFunc $logFunc, MailFunc $mailFunc) {
      
        $this->secureFunc = $secureFunc;
        $this->logFunc = $logFunc;
        $this->mailFunc = $mailFunc;
    }
    
    public function checkMailUrl(UserPowerFunc $powerFunc,BaseFunc $baseFunc)
    {
       
        if(session("user.user_status")==true)
        {
            $baseFunc->setRedirectMessage(true, "已经激活成功", NULL, "/user_index");
            exit();
        }
        
        $key = Request::input("key");
        //$id = Request::input("id");
        $result = $this->secureFunc->checkUrl($key);
        /*dump($result);
        dump(session("secure"));*/
       if($result!=false)
       {
          if(session("secure.secure_class")==0)
          {
              
              $this->secureFunc->setUserActivate(session("secure.secure_user"));
              DB::table("base_user_secure")->where("secure_key","=",$key)->delete();
             /*在这里应该把登陆的的事情都干了
              */
              
            $userData = DB::table("base_user")
             ->where("user_id", "=", session("secure.secure_user"))
             ->first();
             $sessionInitData["user_status"] = true;
             $sessionInitData["user_id"] = $userData->user_id;
             $sessionInitData["user_nickname"] = $userData->user_nickname;
             $sessionInitData["user_group"] = $userData->user_group;
             $sessionInitData["user_power"] = $powerFunc->getUserPower($userData->user_id);
             session(["user"=>$sessionInitData]);//session结构请见ReadMe文档
             
             
             session(["secure" => null]);
             $baseFunc->setRedirectMessage(true, "激活成功", NULL, "/user_index");
            
          }
          //以后如果还有
           
       }
       else
       {
           echo "非法参数";
           
       }
    }
    public function sendMailUrl()
    {
        $this->mailFunc->sendUserCheckMail("714114216@qq.com","王钧泰", 1);

    }
    
    
}
