<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\UserPowerFunc;
use GirdPlugins\Base\UserFunc;
use GirdPlugins\Base\LogFunc;
use GirdPlugins\Base\MailFunc;

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
    //这里增加一个功能，用于用户注册
    public function register()
    {
        return view("User.register");
    }
    //处理注册数据

    public function _register(LogFunc $logFunc,UserFunc $userFunc,BaseFunc $baseFunc,MailFunc $mailFunc)
    {
        $input_data = Request::only("user_username","user_nickname","user_password","user_sex","user_intro");
        $email = Request::only("user_email");
        DB::beginTransaction();
        if($user_id = $userFunc->addUser($input_data) != false)
        {
            //注册成功
            //注册成功后向该用户发送电子邮件
            $mailFunc->sendUserCheckMail($email['user_email'], $input_data['user_nickname'], $user_id);
            //注册成功后添加日志
            $logFunc->addLog([
                "log_level"=>0,
                "log_title"=>$input_data['user_username']."注册了此网站",
                "log_detail"=>$input_data['user_username']."注册了此网站",
                "log_admin"=>session("user.user_id")
            ]);
            DB::commit();
            return response()->json(['status' => true, 'message' => "<p style='font-size:18px;font-family:微软雅黑'>"
                . "恭喜{$input_data['user_username']},您已注册成功"
            . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                    . "系统将在<font color='black' size='3'><span id='myspan'>5</span></font>秒后为你跳转</p>"]);
            //$baseFunc->setRedirectMessage(true, "注册成功,以跳转到登录页面", null, "/user_login");
        }
        else
        {
            //注册失败
            return response()->json(['status' => false, 'message' => '注册失败，请重新填写注册信息']);
        }
        //dump($input_data);
    }
    /*public function _register(LogFunc $logFunc,UserFunc $userFunc,BaseFunc $baseFunc,MailFunc $mailFunc)
    {
        $input_data = Request::only("user_username","user_nickname","user_password","user_sex","user_intro");
        $email = Request::only("user_email");
        DB::beginTransaction();
        if($user_id = $userFunc->addUser($input_data) != false)
        {
            //注册成功
            //注册成功后向该用户发送电子邮件
            $mailFunc->sendUserCheckMail($email['user_email'], $input_data['user_nickname'], $user_id);
            //注册成功后添加日志
            $logFunc->addLog([
                "log_level"=>0,
                "log_title"=>$input_data['user_username']."注册了此网站",
                "log_detail"=>$input_data['user_username']."注册了此网站",
                "log_admin"=>session("user.user_id")
            ]);
            DB::commit();
            $baseFunc->setRedirectMessage(true, "注册成功,以跳转到登录页面", null, "/user_login");
        }
        else
        {
            //注册失败
            $baseFunc->setRedirectMessage(false, "注册失败,用户名已存在，请重新注册！", null, "/user_register");
        }
        //dump($input_data);
    }*/

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
