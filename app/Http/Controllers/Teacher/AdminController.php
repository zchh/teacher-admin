<?php
/**
 * Created by PhpStorm.
 * User: 57156
 * Date: 2017/10/30
 * Time: 11:03
 */

namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
//use BaseClass\Role\Admin;
use BaseClass\Teacher\Admin;
use BaseClass\Teacher\Teacher;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\AdminPowerFunc;

/**
 * 管理员
 */
class AdminController extends Controller
{
    /**
     *  登录页面
     */
    public function adminLogin(){
        return view("Teacher.AdminView.adminLogin");
    }

    /**
     *  校验登录
     */
    public function checkAdminLogin(BaseFunc $baseFunc){
        $inputData = Request::only("admin_name","password");
        $param['admin_name'] = $inputData['admin_name'];
        $result = Admin::findOne($param);
        if(false == empty($result)){
            if($result->password == md5($inputData['password'])){
                session(["admin" => $result]);
                $baseFunc->setRedirectMessage(true, "登陆成功", NULL, "/t_admin_index");
            }
        }else{
            $baseFunc->setRedirectMessage(false, "错误的用户名和密码", NULL, "/t_admin_login");
        }
    }

    /**
     * 退出登录
     */
    public function adminLoginOut(BaseFunc $baseFunc)
    {
        Session::flush();
        $baseFunc->setRedirectMessage(true, "登出成功", NULL, "/t_admin_login");
    }

    /**
     * 首页
     */
    public function adminIndex(){




        return view("Teacher.AdminView.index");
    }

    /**
     * 教师
     */
    public function searchTeacher(BaseFunc $baseFunc){
        $data['teachers'] = Teacher::getAll();
        return view("Teacher.AdminView.teacherList", $data);
    }

    /**
     * 添加教师
     */
    public function addTeacher(BaseFunc $baseFunc){
         $input['name'] = $_POST["name"];
         $input['id_number'] = $_POST['id_number'];
         $input['user_name'] = $_POST['user_name'];
         $input['password'] = md5($_POST['password']);
         $input['sex'] = $_POST['sex'];
         //$input['pic'] =
         $teacher = Teacher::add($input);
         if(false == empty($teacher)){
             $baseFunc->setRedirectMessage(true, "数据插入成功", NULL, "/t_s_teacher");
         }else{
             $baseFunc->setRedirectMessage(false, "数据插入失败", NULL, "/user_sMessage");
         }
    }

    /**
     * 编辑教师
     */
    public function editTeacher(){

    }


    /**
     * 删除教师
     */
    public function deleteTeacher(){

    }


    /**
     * 学生
     */
    public function searchStudent(){

    }

    /**
     * 添加学生
     */
    public function addStudent(){

    }


    /**
     * 编辑学生
     */
    public function editStudent(){

    }

    /**
     * 删除学生
     */
    public function deleteStudent(){

    }


    /**
     * 班级
     */
    public function searchClass(){

    }

    /**
     * 添加班级
     */
    public function addClass(){

    }

    /**
     * 编辑班级
     */
    public function editClass(){

    }

    /**
     * 删除班级
     */
    public function deleteClass(){

    }

    /**
     * 专业
     */
    public function searchMajor(){

    }

    /**
     * 添加专业
     */
    public function addMajor(){

    }

    /**
     * 编辑专业
     */
    public function editMajor(){

    }

    /**
     * 删除专业
     */
    public function deleteMajor(){

    }







}