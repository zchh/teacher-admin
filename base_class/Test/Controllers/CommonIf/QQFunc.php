<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2015/12/4
 * Time: 16:26
 */

namespace BaseClass\Test\Controllers\CommonIf;//改
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
        $dialog_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id="
            . $this->app_id . "&redirect_uri=" . urlencode($this->my_url) . "&state="
            . session('state');
        echo("<script> top.location.href='" . $dialog_url . "'</script>");

    }
    //2：通过Authorization Code获取Access Token
    public function qq_callback($code,$state)
    {
        if($state == session('state'))
        {
            //拼接URL
            $token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
                . "client_id=" . $this->app_id . "&redirect_uri=" . urlencode($this->my_url)
                . "&client_secret=" . $this->app_secret . "&code=" . $code;
            $response = file_get_contents($token_url);
            $access_token = '';
            if(!empty($response))
            {
                $deng = strpos($response, "=");//第一次=出现
                $kuo = strpos($response, "&");//第一次&出现
                $access_token.= substr($response, $deng + 1, $kuo - $deng - 1);
            }
            else
            {
                return false;
            }
            //dump($access_token);
            /*if (strpos($response, "callback") !== false)
            {
                $lpos = strpos($response, "(");//第一次出现
                $rpos = strrpos($response, ")");//最后一次
                $response  = substr($response, $lpos + 1, $rpos - $lpos -1);
                $msg = json_decode($response);
                if (isset($msg->error))
                {
                    echo "<h3>error:</h3>" . $msg->error;
                    echo "<h3>msg  :</h3>" . $msg->error_description;
                    exit;
                }
            }*/

            //Step3：使用Access Token来获取用户的OpenID
            $params = array();
            parse_str($response, $params);
            $graph_url = "https://graph.qq.com/oauth2.0/me?access_token=$access_token";
            $params['access_token'] = $access_token;
            $str  = file_get_contents($graph_url);
            if (strpos($str, "callback") !== false)
            {
                $lpos = strpos($str, "(");//括号第一次出现位置
                $rpos = strrpos($str, ")");//括号最后一次出现的位置
                $str  = substr($str, $lpos + 1, $rpos - $lpos -1);
            }
            else
            {
                return false;
            }
            $user = json_decode($str);
            $params['openID'] = $user->openid;
            if (isset($user->error))
            {
                /*echo "<h3>error:</h3>" . $user->error;
                echo "<h3>msg  :</h3>" . $user->error_description;
                exit;*/
                return false;
            }
            return $params;
            //echo("Hello " . $user->openid);
        }
        else
        {
            return false;
        }
    }
}