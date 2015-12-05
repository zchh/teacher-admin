<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2015/12/4
 * Time: 15:35
 */

namespace BaseClass\Test\Controllers\CommonIf;
use BaseClass\Test\Controllers\CommonIf\QQFunc;
use BaseClass\Role\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use GirdPlugins\Base\BaseFunc;

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
                $base_data['access_token'] = $data['access_token'];
                $base_data['openID'] = $data['openID'];
                $base_data['token_create_date'] = date("Y-m-d H:i:s");
                DB::table("base_token")->insert($base_data);
                $user_data = User::qqLogin($data['access_token'],$data['openID']);
                if($user_data != false && $user_data != true)
                {
                    dump($user_data);
                    //$baseFunc = new BaseFunc();
                    //$baseFunc->setRedirectMessage(true,"系统已自动为你注册，为了你的个人信息安全请及时修改密码和个人资料！<a href='#'></a>",null,"/user_index");
                }
                else
                {
                    dump($user_data);
                }
            }
        }
    }

}