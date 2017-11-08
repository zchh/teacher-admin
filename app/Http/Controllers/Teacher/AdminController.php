<?php
/**
 * Created by PhpStorm.
 * User: 57156
 * Date: 2017/10/30
 * Time: 11:03
 */

namespace App\Http\Controllers\Teacher;
use App\Http\Config\NumberKey;
use App\Http\Controllers\Controller;
//use BaseClass\Role\Admin;
use BaseClass\Component\Image\Image;
use BaseClass\Teacher\Admin;
use BaseClass\Teacher\Pic;
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
    public function searchTeacher(){
        session(["now_address"=>"/admin_sClass"]);
        $teachers =  Teacher::getAll(10);
        $arr = array();
        foreach ($teachers as $teacher) {
            $single['teacher_id'] = $teacher->teacher_id;
            $single['name'] = $teacher->name;
            $single['id_number'] = $teacher->id_number;
            $single['user_name'] = $teacher->user_name;
            $single['sex'] = $teacher->sex;
            $single['sex'] = ($teacher->sex == 1)?'男':'女';
            $single['create_time'] = $teacher->create_time;
            $query['id'] = $teacher->pic_id;
            $single['pic_id'] =  $teacher->pic_id;
            $arr[] = $single;
        }
        $data['arr'] = $arr;
        return view("Teacher.AdminView.teacherList", $data);
    }

    /**
     * 添加教师
     */
    public function addTeacher(BaseFunc $baseFunc){
        if (!request::hasFile('pic')) {
            $baseFunc->setRedirectMessage(false, "错误，上传失败", NULL);
            return redirect()->back();  //跳回上一页
        }
        $file = Request::file('pic');
        $picId = Pic::addPic(1,$file);
        if(false == $picId){
            $baseFunc->setRedirectMessage(false, "错误，上传失败", NULL);
            return redirect()->back();  //跳回上一页
        }
        $inputData['pic_id'] = $picId;
        $inputData['name'] = $_POST['name'];
        $inputData['id_number'] = $_POST['id_number'];
        $inputData['user_name'] = $_POST['user_name'];
        $inputData['password'] = md5($_POST['password']);
        $inputData['sex'] = $_POST['sex'];
        $return = Teacher::add($inputData);
        if($return == true) {
            $baseFunc->setRedirectMessage(true, "数据插入成功", NULL);
        } else {
            $baseFunc->setRedirectMessage(false, "数据插入失败", NULL);
        }
        return redirect()->back();
    }

    /**
     * 编辑教师
     */
    public function editTeacher(BaseFunc $baseFunc){
        if (request::hasFile('pic')) {
            $file = Request::file('pic');
            $picId = Pic::addPic(1,$file);
            if(false == $picId){
                $baseFunc->setRedirectMessage(false, "错误，上传失败", NULL);
                return redirect()->back();  //跳回上一页
            }
            $inputData['pic_id'] = $picId;
        }
        $inputData['name'] = $_POST['name'];
        $inputData['id_number'] = $_POST['id_number'];
        $inputData['user_name'] = $_POST['user_name'];
        $inputData['sex'] = $_POST['sex'];
        $teacher = new Teacher($_POST['teacher_id']);
        $return = $teacher->update($inputData);
        if($return == true) {
            $baseFunc->setRedirectMessage(true, "数据修改成功", NULL);
        } else {
            $baseFunc->setRedirectMessage(false, "数据修改失败", NULL);
        }
        return redirect()->back();
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