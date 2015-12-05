<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2015/12/4
 * Time: 16:26
 */

namespace BaseClass\Test\Controllers\CommonIf;
use Illuminate\Support\Facades\DB;

class QQFunc
{
    //应用的APPID
    private $app_id;
    //应用的APPKEY
    private $app_secret;
    //成功授权后的回调地址
    private $my_url;

    public function __construct()
    {
        $this->app_id = '101275342';
        $this->app_secret = '6d2439485fdec03bc81a22a91d48d6db';
        $this->my_url = 'http://www.jtcool.com/if_qq';
    }

    public function qq_login()
    {
        //1：获取Authorization Code

            //state参数用于防止CSRF攻击，成功授权后回调时会原样带回
            $state = md5(uniqid(rand(), TRUE));
            session(['state'=>$state]);
            //拼接URL
        //https://graph.qq.com/oauth/show?which=Login&display=pc&response_type=code&client_id=101275342&redirect_uri=http%3A%2F%2Fwww.jtcool.com%2Fif_qq&state=6f0872476f1b3f6fdc9462d27e138134
            $dialog_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id="
                . $this->app_id . "&redirect_uri=" . urlencode($this->my_url) . "&state="
                . session('state');
            echo("<script> top.location.href='" . $dialog_url . "'</script>");

    }

    public function qq_callback($code,$state)
    {
        //2：通过Authorization Code获取Access Token
        if($state == session('state'))
        {
            //拼接URL
            $token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
                . "client_id=" . $this->app_id . "&redirect_uri=" . urlencode($this->my_url)
                . "&client_secret=" . $this->app_secret . "&code=" . $code;
            $response = file_get_contents($token_url);
            dump($response);
            if (strpos($response, "callback") !== false)
            {
                $lpos = strpos($response, "(");
                $rpos = strrpos($response, ")");
                $response  = substr($response, $lpos + 1, $rpos - $lpos -1);
                $msg = json_decode($response);
                if (isset($msg->error))
                {
                    echo "<h3>error:</h3>" . $msg->error;
                    echo "<h3>msg  :</h3>" . $msg->error_description;
                    exit;
                }
            }

            //Step3：使用Access Token来获取用户的OpenID
            /*$params = array();
            parse_str($response, $params);
            $graph_url = "https://graph.qq.com/oauth2.0/me?access_token= ";
            $params['access_token'];
            $str  = file_get_contents($graph_url);
            if (strpos($str, "callback") !== false)
            {
                $lpos = strpos($str, "(");
                $rpos = strrpos($str, ")");
                $str  = substr($str, $lpos + 1, $rpos - $lpos -1);
            }
            $user = json_decode($str);
            if (isset($user->error))
            {
                echo "<h3>error:</h3>" . $user->error;
                echo "<h3>msg  :</h3>" . $user->error_description;
                exit;
            }
            echo("Hello " . $user->openid);*/
        }
        else
        {
            echo("The state does not match. You may be a victim of CSRF.");
        }
    }
}