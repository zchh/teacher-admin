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
  public function login(BaseFunc $baseFunc)
  {
      
      if( session("user.user_status") ){$baseFunc->setRedirectMessage(true, "你已经登陆，自动跳转到主页", NULL, "/user_index");}
      return view("User.login");
  }
  public function _login(BaseFunc $baseFunc,  UserPowerFunc $powerFunc )
  {
        $inputData = Request::only("user_username","user_password");
        
        $userData = $baseFunc->loginUserCheck($inputData["user_username"],$inputData["user_password"]);
        if($userData != false )
        {
            //if($userData->user_true == false){$baseFunc->setRedirectMessage(false, "用户未激活", NULL, "/user_login");}
            $sessionInitData["user_status"] = true;
            $sessionInitData["user_id"] = $userData->user_id;
            $sessionInitData["user_nickname"] = $userData->user_nickname;
            $sessionInitData["user_group"] = $userData->user_group;
            $sessionInitData["user_image"] = $userData->user_image;
            $sessionInitData["user_power"] = $powerFunc->getUserPower($userData->user_id);
            session(["user"=>$sessionInitData]);//session结构请见ReadMe文档


            //查看登录前是否有页面请求
            if(session("redirect.status",NULL) != NULL)
            {
                $url = session("redirect.url");
                session(["redirect" => null]);
                $baseFunc->setRedirectMessage(true, "登陆成功,继续操作", NULL, $url);
            }
            else
            {
                $baseFunc->setRedirectMessage(true, "登陆成功", NULL, "/user_index");
            }
            
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
        
        $input_data = Request::only("user_username","user_nickname","user_password","user_sex","user_intro","user_email");
       // dump($input_data);exit();
        $email = Request::only("user_email");
        if($email == null)
        {
            return response()->json(['status' => false, 'message' => '注册失败，邮箱不能为空，请重新填写注册信息']);
        }
        DB::beginTransaction();
        if($user_id = $userFunc->addUser($input_data) != false)
        {
            //注册成功
            //注册成功后向该用户发送电子邮件
            //$mailFunc->sendUserCheckMail($email['user_email'], $input_data['user_nickname'], $user_id);邮箱暂不可用
            //注册成功后添加日志
            $logFunc->addLog([
                "log_level"=>0,
                "log_title"=>$input_data['user_username']."注册了此网站",
                "log_detail"=>$input_data['user_username']."注册了此网站",
                "log_admin"=>session("user.user_id")
            ]);
            DB::commit();
            return response()->json(['status' => true, 'message' => "<p style='font-size:18px;font-family:微软雅黑'>"
                . "{$input_data['user_username']},您已注册成功"
            . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                    . "即将跳转"]);
            //$baseFunc->setRedirectMessage(true, "注册成功,以跳转到登录页面", null, "/user_login");
        }
        else
        {
            //注册失败
            return response()->json(['status' => false, 'message' => '注册失败，用户名已被占用，请重新填写注册信息']);
        }
        //dump($input_data);
    }
    
  public function index(BaseFunc $baseFunc)   //用户主页

  {
      //dump(session("user"));

      $user_id = session("user.user_id"); //获取当前登录用户的id,传给BaseController来获取他所关注的人的所有文章
      //调用接口获取被关注用户的所有文章
      $input_data['article_attentioned_data'] = $baseFunc->getArticleByAttentioned($user_id);
      //dump($input_data);
      return view("User.index",$input_data);

     
  }
   public function logout(BaseFunc $baseFunc)
   {
       Session::flush();
       $baseFunc->setRedirectMessage(true, "登出成功", NULL, "/user_login");
   }

}
