<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use BaseClass\Role\Admin;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\AdminPowerFunc;

class BaseController extends Controller {
    public function login()
    {
        return view("Admin.login");
    }
    public function _login(BaseFunc $baseFunc)
    {
        $inputData = Request::only("admin_username","admin_password");
        $userData = Admin::loginAdminCheck($inputData["admin_username"],$inputData["admin_password"]);
        if($userData != false)
        {
            Admin::login($userData);
            $baseFunc->setRedirectMessage(true, "登陆成功", NULL, "/admin_index");
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "错误的用户名和密码", NULL, "/admin_login");
        }
        
    }
    public function index()
    {
        return view("Admin.index");
        
    }
    public function logout(BaseFunc $baseFunc)
    {
        Session::flush();
        $baseFunc->setRedirectMessage(true, "登出成功", NULL, "/admin_login");
    }
}
