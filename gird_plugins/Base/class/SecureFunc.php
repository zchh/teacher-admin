<?php
namespace GirdPlugins\Base;
use Illuminate\Support\Facades\DB;
use GirdPlugins\Base\LogFunc;
class SecureFunc
{
     public function __construct(LogFunc $logFunc) {
        
        $this->logFunc = $logFunc;
    }
     /**
     * 
     * 生成一个验证链接
     * @access public
     * @param str $recvAdr      接收者邮箱地址
     * @param int $user_class   类型= 0注册/1重置密码  
     * @return url/Bool
     */
    public function generateCheckUrl($user_id, $class)
    {
        $secureData["secure_class"]=$class;
        $secureData["secure_key"] = md5($user_id.rand(10000,99999).$class);
        $secureData["secure_date"] = date('Y-m-d H:i:s');
        $secureData["secure_user"] = $user_id;
        if($id = DB::table("base_user_secure")->insertGetId($secureData))
        {
            $url = config("my_config.website_url").config("my_config.secure_check_url")."?key=".$secureData["secure_key"];
            $this->logFunc->addLog(
                ["log_level"=>2,
                "log_title"=>"生成了一个连接，用于密码重置或者注册,id=".$id,
                "log_detail"=>$url,
                "log_user"=>$user_id]);
            return  $url;
        }
        else
        {
            return false;
        }
    }
    
     /**
     * 
     * 检查一个验证链接是否正确
     * @access public
     * @param str $key      关键串
     * @return Bool
     * 我们将重置的类别放在secure.secure_class中
     */
    public function checkUrl($key)
    {
        
        $secureData = DB::table("base_user_secure")->where("secure_key","=",$key)->where("secure_date",">",time()-600)->first();
        //dump($secureData);
        if($secureData!=NULL)
        {
            //echo "有数据";
            if($key == $secureData->secure_key)
            {
                //echo "数据key正确";
                
                $this->logFunc->addLog(
                ["log_level"=>2,
                "log_title"=>"用户点击链接，邮箱连接验证已经失效 id=".$secureData->secure_id,
                "log_detail"=>"用户请求 ".$secureData -> secure_class,
                "log_user"=>$secureData -> secure_user]);
                
                
                $power["secure_class"] = $secureData -> secure_class;
                $power["secure_user"] = $secureData -> secure_user;
                session(["secure" => $power]);
                
                //$re = DB::table("base_user_secure")->where("secure_id","=",$id)->delete();
                return true;
                
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    
    
     /**
     * 
     * 激活一个用户，在链接点击页面调用
     * @access public
     * @return Bool
     * 我们将重置的类别放在secure.secure_class中
     */
    public function setUserActivate($user_id)
    {
        if(DB::table("base_user")->where("user_id","=",$user_id)->update(["user_true"=>true]))
        {
           
            return true;
        }
        else
        {
            return false;
        }
        
        
    }
}

