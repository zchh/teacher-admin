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
            dump($code);
            $qqFunc->qq_callback($code, $state);

        }
        if(!empty($_GET['access_token']))
        {
            $access_token = $_GET['access_token'];
            dump($access_token);
            //$qqFunc->getOpenID($access_token);
        }
    }
}