<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2015/12/4
 * Time: 15:35
 */

namespace BaseClass\Test\Controllers\CommonIf;
use BaseClass\Test\Controllers\CommonIf\QQFunc;

use App\Http\Controllers\Controller;

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
            $qqFunc->qq_callback($code, $state);
        }
    }
    public function aa()
    {
        $response = "access_token=27DD283221567D3F116B6878A3E4F1D7&expires_in=7776000&refresh_token=7FB7906404184CDEA98B85AAF8E5C6BA";
        dump($response);
        $deng = strpos($response, "=");//第一次=出现
        $kuo = strpos($response, "&");//第一次&出现
        $access_token = substr($response,$deng+1,$kuo - $deng -1);
        dump($access_token);
    }
}