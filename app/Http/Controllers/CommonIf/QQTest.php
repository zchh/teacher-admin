<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2015/12/4
 * Time: 15:35
 */

namespace App\Http\Controllers\CommonIf;//改
use App\Http\Controllers\CommonIf\QQFunc;//改
use GirdPlugins\Base\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\LogFunc;

class QQTest extends Controller
{
    public function test(QQFunc $qqFunc)
    {
        $qqFunc->qq_login();
        //return view("User.login");
    }
    //回调函数
    public function syntony(QQFunc $qqFunc)
    {
        if(!empty($_GET['code']))
        {
            $code = $_GET['code'];
            $state = $_GET['state'];
            $data = $qqFunc->qq_callback($code, $state);
            if($data != false)
            {
                //把返回来的token和openID存入数据库
                $input_data = DB::table("base_token")->where("openID","=",$data['openID'])->first();
                if(empty($input_data))
                {
                    $base_data['access_token'] = $data['access_token'];
                    $base_data['openID'] = $data['openID'];
                    $base_data['token_create_date'] = date("Y-m-d H:i:s");
                    DB::table("base_token")->insert($base_data);
                    //这里从QQ服务器返回来的数据要以日志的形式存入数据库，便于查找错误
                    $logFunc = new LogFunc();
                    $log_array["log_level"] = 3;
                    $log_array["log_title"] = "qq登录";
                    $log_array["log_detail"] = "用户在登录之后将返回一个accass_token和一个openID，一个用户是唯一的";
                    $log_array["log_data"] = "access_token:".$data['access_token']."openID:".$data['openID']."返回日期:".date("Y-m-d H:i:s");
                    $logFunc->insertLog($log_array);

                }
                $user_data = User::qqLogin($data['access_token'], $data['openID']);
                //dump($user_data);
                if ($user_data !== false && $user_data !== true)
                {
                    //echo '登录成功,系统已经为你自动注册';
                    //dump($user_data);
                    $baseFunc = new BaseFunc();
                    $baseFunc->setRedirectMessage(true,"系统已自动为你注册，为了你的个人信息安全请及时修改密码和个人资料！<a href='#'>www.baidu.com</a>",null,"/user_index");
                    //echo "<script language='javascript'>alert('系统已自动为你注册，为了你的个人信息安全请及时修改密码和个人资料!');window.location.href='/user_index';</script>";
                }
                else
                {
                    $baseFunc = new BaseFunc();
                    $baseFunc->setRedirectMessage(true,"登录成功，并已绑定",null,"/user_index");
                }
            }
        }
    }

}