<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\UserPowerFunc;
class BaseController extends Controller {
  public function login()
  {
      return view("User.login");
  }
  public function _login(BaseFunc $baseFunc,  UserPowerFunc $powerFunc )
  {
        $inputData = Request::only("user_username","user_password");
        
        $userData = $baseFunc->loginUserCheck($inputData["user_username"],$inputData["user_password"]);
        if($userData != false)
        {
            $sessionInitData["user_status"] = true;
            $sessionInitData["user_id"] = $userData->user_id;
            $sessionInitData["user_nickname"] = $userData->user_nickname;
            $sessionInitData["user_group"] = $userData->user_group;
            $sessionInitData["user_power"] = $powerFunc->getUserPower($userData->user_id);
            session(["user"=>$sessionInitData]);//session结构请见ReadMe文档
            
            $baseFunc->setRedirectMessage(true, "登陆成功", NULL, "/user_index");
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "错误的用户名和密码", NULL, "/user_login");
        }
  }
  public function index()
  {
      //dump(session("user"));
      return view("User.index");
     
  }
   public function logout(BaseFunc $baseFunc)
   {
       Session::flush();
       $baseFunc->setRedirectMessage(true, "登出成功", NULL, "/admin_login");
   }

  
}
