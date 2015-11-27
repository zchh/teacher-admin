<?php
namespace GirdPlugins\Base;
use \Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use GirdPlugins\Base\SecureFunc;
use GirdPlugins\Base\LogFunc;

class MailFunc
{
    
    
    public function __construct(SecureFunc $secureFunc,LogFunc $logFunc) {
        $this->secureFunc = $secureFunc;
        $this->logFunc = $logFunc;
    }

    /**
     * 
     * 发送一个带有验证链接的邮件，主要用在注册，修改密码时
     * @access public
     * @param str $recvAdr      接收者邮箱地址
     * @param str $recName      接收者昵称
     * @param str $checkUser    要检查的用户的id
     * @param str $recvTitle = NULL  标题，忽略自动生成
     * @return Bool
     * 发送用户检查邮件，依赖secureFunc中的生成连接函数
     */
    
    public function sendUserCheckMail($recvAdr, $recvName, $checkUser, $recvTitle=NULL)
    {     
        if($recvTitle == NULL)
        {
             $recvTitle.="用户操作验证链接，来自于 ".config("my_config.mail_head_name");
        }
       
       
        $checkLink = $this->secureFunc->generateCheckUrl($checkUser,0);
        
       
        $data["recvAdr"] = $recvAdr;
        $data["recvName"] = $recvName;
        $data["recvTitle"] = $recvTitle;
        session(["mail"=>$data]);
       
        
        Mail::send('Base::Mail.sendRegisterMail', ["checkLink"=> $checkLink,"recvName"=>$recvName], function($message)
        {
          $message->to(session("mail.recvAdr"), session("mail.recvName"))->subject(session("mail.recvTitle"));
           
        });
        session(["mail" => null]);
         $this->logFunc->addLog(
                ["log_level"=>2,
                "log_title"=>"发送了一封电子邮件，用于重置",
                "log_detail"=>"addr=".$data["recvAdr"]."  recv_name=".$data["recvName"]."  recv_title=".$data["recvTitle"]."  check_user=".$checkUser,
                "log_user"=>$checkUser]);

    }
    
    

}
