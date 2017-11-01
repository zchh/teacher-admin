<?php
/**
 * Created by PhpStorm.
 * User: 57156
 * Date: 2017/10/30
 * Time: 11:03
 */

namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
use BaseClass\Role\Admin;
use BaseClass\Teacher\Teacher;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\AdminPowerFunc;

/**
 * 教师
 */
class TeacherController extends Controller
{
    /**
     *  登录页面
     */
    public function teacherLogin(){
        return view("Teacher.TeacherView.teacherLogin");
    }

    /**
     *  校验登录
     */
    public function checkTeacherLogin(BaseFunc $baseFunc){
        $inputData = Request::only("user_name","password");
        $param['user_name'] = $inputData['user_name'];
        $result = Teacher::findOne($param);
        if(false == empty($result)){
            if($result->password == md5($inputData['password'])){
                $baseFunc->setRedirectMessage(true, "登陆成功", NULL, "/admin_index");
            }
        }
        $baseFunc->setRedirectMessage(false, "错误的用户名和密码", NULL, "/t_admin_login");
    }







}