<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use GirdPlugins\Ajax\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class BaseController extends Controller {
    public function login()
    {
        return view("Admin.login");
    }
    public function _login(BaseFunc $baseFunc)
    {
        $inputData = Request::only("admin_username","admin_password");
        $userData = DB::table("base_admin")
                ->where("admin_username","=",$inputData["admin_username"])
                ->where("admin_password","=",md5($inputData["admin_password"]))
                ->first();
        if($userData != NULL)
        {
            $sessionInitData["admin_id"] = $userData->admin_id;
            $sessionInitData["admin_nickname"] = $userData->admin_nickname;
            $sessionInitData["admin_group"] = $userData->admin_group;
            session(["admin"=>$sessionInitData]);//session结构请见ReadMe文档
            $baseFunc->setRedirectMessage(true, "登陆成功", NULL, "/admin_index");
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "错误的用户名和密码", NULL, "/admin_login");
        }
        
    }
    public function index()
    {
        return view("admin.index");
        dump(session("admin.admin_id"));
    }
    public function logout(BaseFunc $baseFunc)
    {
        Session::flush();
        $baseFunc->setRedirectMessage(true, "登出成功", NULL, "/admin_login");
    }
}
