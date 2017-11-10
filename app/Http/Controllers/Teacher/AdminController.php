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
use BaseClass\Teacher\ClassConfig;
use BaseClass\Teacher\MajorConfig;
use BaseClass\Teacher\Pic;
use BaseClass\Teacher\Student;
use BaseClass\Teacher\Teacher;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\AdminPowerFunc;
use Illuminate\Pagination\Paginator;

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
                $data['admin_id'] = $result->id;
                $data['admin_name'] = $result->admin_name;
                session(["admin" => $data]);
                $baseFunc->setRedirectMessage(true, "登陆成功", NULL, "/t_admin_index");
            }else{
                $baseFunc->setRedirectMessage(false, "错误的用户名和密码", NULL, "/t_admin_login");
                return redirect()->back();
            }
        }else{
            $baseFunc->setRedirectMessage(false, "错误的用户名和密码", NULL, "/t_admin_login");
            return redirect()->back();
        }
    }

    /**
     * 获取管理员信息
     */
    public function getAdminInfo(BaseFunc $baseFunc){
        if(true == empty(session('admin'))){
            $baseFunc->setRedirectMessage(false, "获取管理员信息失败", NULL, "/t_admin_login");
        }
        $adminInfo =  new Admin(session('admin')['admin_id']);
        $data['adminInfo'] = $adminInfo->info;
        return view("Teacher.AdminView.adminInfo", $data);
    }

    /**
     * 编辑管理员
     */
    public function editAdminInfo(BaseFunc $baseFunc){
        $arr['number'] = $_POST['number'];
        $arr['admin_name'] = $_POST['admin_name'];
        $arr['name'] = $_POST['name'];
        $arr['id_number'] = $_POST['id_number'];
        $adminObj = new Admin($_POST['id']);
        $return = $adminObj->update($arr);
        if(false == $return){
            $baseFunc->setRedirectMessage(false, "修改管理员失败", NULL, "");
        }
        return redirect()->back();
    }

    /**
     * 管理员修改密码
     */
    public function updatePassword(BaseFunc $baseFunc){
        if(true == empty(session('admin'))){
            $baseFunc->setRedirectMessage(false, "修改密码失败", NULL, "/t_admin_login");
        }
        $admin = new Admin(session('admin')['admin_id']);
        if(md5($_POST['old_password']) != $admin->info->password){
            $baseFunc->setRedirectMessage(false, "原密码错误", NULL, "");
            return redirect()->back();
        }
        if($_POST['new_password_1'] != $_POST['new_password_2']){
            $baseFunc->setRedirectMessage(false, "两次输入密码不匹配", NULL, "");
            return redirect()->back();
        }
        $arr['password']= md5($_POST['new_password_1']);
        $return = $admin->update($arr);
        if(false == $return){
            $baseFunc->setRedirectMessage(false, "修改密码失败", NULL, "");
            return redirect()->back();
        }else{
            $baseFunc->setRedirectMessage(true, "密码修改成功", NULL, "/t_admin_login");
        }
    }


    /**
     * 退出登录
     */
    public function adminLoginOut(BaseFunc $baseFunc){
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
        session(["now_address"=>"/t_s_teacher"]);
        $data['arr'] =  Teacher::getAll(1);
        return view("Teacher.AdminView.teacherList", $data);
    }

    /**
     * 添加教师
     */
    public function addTeacher(BaseFunc $baseFunc){
        if (!request::hasFile('pic')) {
            $baseFunc->setRedirectMessage(false, "错误，上传失败", NULL);
            return redirect()->back();
        }
        $file = Request::file('pic');
        $picId = Pic::addPic(1,$file);
        if(false == $picId){
            $baseFunc->setRedirectMessage(false, "错误，上传失败", NULL);
            return redirect()->back();
        }
        //判断是否已经存在相同用户名
        $param['user_name'] =  $_POST['user_name'];
        $result = Teacher::findOne($param);
        if(false == empty($result)){
            $baseFunc->setRedirectMessage(false, "存在相同的用户名", NULL);
            return redirect()->back();
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
                return redirect()->back();
            }
            $inputData['pic_id'] = $picId;
        }
        //判断是否已经存在相同用户名
        $param['user_name'] =  $_POST['user_name'];
        $result = Teacher::findOne($param);
        if(false == empty($result)){
            $baseFunc->setRedirectMessage(false, "存在相同的用户名，请更换用户名", NULL);
            return redirect()->back();
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
    public function deleteTeacher(BaseFunc $baseFunc, $teacher_id){
       if(true == empty($teacher_id)){
           $baseFunc->setRedirectMessage(false, "参数错误", NULL);
           return redirect()->back();
       }
       DB::beginTransaction();
       $teacherObj = new Teacher($teacher_id);
       $picId = $teacherObj->info->pic_id;
       $result = $teacherObj->delete();
       if(false == $result){
           $baseFunc->setRedirectMessage(false, "删除失败", NULL);
           return redirect()->back();
       }
       $pic = new Pic($picId);
       $result = $pic->delete();
       if(false == $result){
           $baseFunc->setRedirectMessage(false, "删除失败", NULL);
       }
        DB::commit();
        return redirect()->back();
    }


    /**
     * 学生
     */
    public function searchStudent(){
        session(["now_address"=>"/t_s_student"]);
        $data['arr'] = Student::getAll(1);
        $data['classArr'] = ClassConfig::getAll(false);
        return view("Teacher.AdminView.studentList", $data);
    }

    /**
     * 添加学生
     */
    public function addStudent(BaseFunc $baseFunc){
        if (!request::hasFile('pic')) {
            $baseFunc->setRedirectMessage(false, "错误，上传失败", NULL);
            return redirect()->back();
        }
        $file = Request::file('pic');
        $picId = Pic::addPic(1,$file);
        if(false == $picId){
            $baseFunc->setRedirectMessage(false, "错误，上传失败", NULL);
            return redirect()->back();
        }
        //判断是否已经存在相同学号
        $inputData['student_number'] =  $_POST['student_number'];
        $result = Student::findOne($inputData);
        if(false == empty($result)){
            $baseFunc->setRedirectMessage(false, "存在相同的用户名", NULL);
            return redirect()->back();
        }

        $inputData['pic_id'] = $picId;
        $inputData['class_id'] = $_POST['class_id'];
        $inputData['name'] = $_POST['name'];
        $inputData['sex'] = $_POST['sex'];
        $return = Student::add($inputData);
        if($return == true) {
            $baseFunc->setRedirectMessage(true, "数据插入成功", NULL);
        } else {
            $baseFunc->setRedirectMessage(false, "数据插入失败", NULL);
        }
        return redirect()->back();
    }


    /**
     * 编辑学生
     */
    public function editStudent(BaseFunc $baseFunc){
        if (request::hasFile('pic')) {
            $file = Request::file('pic');
            $picId = Pic::addPic(1,$file);
            if(false == $picId){
                $baseFunc->setRedirectMessage(false, "错误，上传失败", NULL);
                return redirect()->back();
            }
            $inputData['pic_id'] = $picId;
        }
        //判断是否已经存在相同学号
        $inputData['student_number'] =  $_POST['student_number'];
        $result = Student::findOne($inputData);
        if(false == empty($result)){
            $baseFunc->setRedirectMessage(false, "存在相同的用户名", NULL);
            return redirect()->back();
        }

        $inputData['class_id'] = $_POST['class_id'];
        $inputData['name'] = $_POST['name'];
        $inputData['sex'] = $_POST['sex'];
        $student = new Student($_POST['student_id']);
        $return = $student->update($inputData);
        if($return == true) {
            $baseFunc->setRedirectMessage(true, "数据修改成功", NULL);
        } else {
            $baseFunc->setRedirectMessage(false, "数据修改失败", NULL);
        }
        return redirect()->back();
    }

    /**
     * 删除学生
     */
    public function deleteStudent(BaseFunc $baseFunc, $student_id){
        if(true == empty($student_id)){
            $baseFunc->setRedirectMessage(false, "参数错误", NULL);
            return redirect()->back();
        }
        DB::beginTransaction();
        $studentObj = new Student($student_id);
        $picId = $studentObj->info->pic_id;
        $result = $studentObj->delete();
        if(false == $result){
            $baseFunc->setRedirectMessage(false, "删除失败", NULL);
            return redirect()->back();
        }
        $pic = new Pic($picId);
        $result = $pic->delete();
        if(false == $result){
            $baseFunc->setRedirectMessage(false, "删除失败", NULL);
        }
        DB::commit();
        return redirect()->back();
    }


    /**
     * 班级
     */
    public function searchClass(){
        session(["now_address"=>"/t_s_class"]);
        $data['arr'] = ClassConfig::getAll(1);
        $data['majorArr'] = MajorConfig::getAll(false);
        return view("Teacher.AdminView.classList", $data);
    }

    /**
     * 添加班级
     */
    public function addClass(BaseFunc $baseFunc){
        //判断是否已经存在相同专业
        $inputData['class_name'] =  $_POST['class_name'];
        $result = ClassConfig::findOne($inputData);
        if(false == empty($result)){
            $baseFunc->setRedirectMessage(false, "存在相同的专业名", NULL);
            return redirect()->back();
        }

        $inputData['major_id'] = $_POST['major_id'];
        $return = ClassConfig::add($inputData);
        if($return == true) {
            $baseFunc->setRedirectMessage(true, "数据插入成功", NULL);
        } else {
            $baseFunc->setRedirectMessage(false, "数据插入失败", NULL);
        }
        return redirect()->back();
    }

    /**
     * 编辑班级
     */
    public function editClass(BaseFunc $baseFunc){
        //判断是否已经存在相同班级名
        $inputData['class_name'] =  $_POST['class_name'];
        $result = ClassConfig::findOne($inputData);
        if(false == empty($result)){
            $baseFunc->setRedirectMessage(false, "存在相同的班级名", NULL);
            return redirect()->back();
        }

        $inputData['major_id'] = $_POST['major_id'];
        $classConfigObj = new ClassConfig($_POST['class_id']);
        $return = $classConfigObj->update($inputData);
        if($return == true) {
            $baseFunc->setRedirectMessage(true, "数据修改成功", NULL);
        } else {
            $baseFunc->setRedirectMessage(false, "数据修改失败", NULL);
        }
        return redirect()->back();
    }

    /**
     * 删除班级
     */
    public function deleteClass(BaseFunc $baseFunc, $class_id){
        if(true == empty($class_id)){
            $baseFunc->setRedirectMessage(false, "参数错误", NULL);
            return redirect()->back();
        }
        $classObj = new ClassConfig($class_id);
        $result = $classObj->delete();
        if(false == $result){
            $baseFunc->setRedirectMessage(false, "删除失败", NULL);
        }
        return redirect()->back();
    }

    /**
     * 专业
     */
    public function searchMajor(){
        session(["now_address"=>"/t_s_major"]);
        $data['arr'] = MajorConfig::getAll(1);
        return view("Teacher.AdminView.majorList", $data);
    }

    /**
     * 添加专业
     */
    public function addMajor(BaseFunc $baseFunc){
        //判断是否已经存在相同专业
        $inputData['major_name'] =  $_POST['major_name'];
        $result = MajorConfig::findOne($inputData);
        if(false == empty($result)){
            $baseFunc->setRedirectMessage(false, "存在相同的专业名", NULL);
            return redirect()->back();
        }
        $return = MajorConfig::add($inputData);
        if($return == true) {
            $baseFunc->setRedirectMessage(true, "数据插入成功", NULL);
        } else {
            $baseFunc->setRedirectMessage(false, "数据插入失败", NULL);
        }
        return redirect()->back();
    }

    /**
     * 编辑专业
     */
    public function editMajor(BaseFunc $baseFunc){
        //判断是否已经存在相同专业名
        $param['major_name'] =  $_POST['major_name'];
        $result = MajorConfig::findOne($param);
        if(false == empty($result)){
            $baseFunc->setRedirectMessage(false, "存在相同的班级名", NULL);
            return redirect()->back();
        }
        $inputData['major_name'] = $_POST['major_name'];
        $majorObj = new MajorConfig($_POST['major_id']);
        $return = $majorObj->update($inputData);
        if($return == true) {
            $baseFunc->setRedirectMessage(true, "数据修改成功", NULL);
        } else {
            $baseFunc->setRedirectMessage(false, "数据修改失败", NULL);
        }
        return redirect()->back();
    }

    /**
     * 删除专业
     */
    public function deleteMajor(BaseFunc $baseFunc, $major_id){
        if(true == empty($major_id)){
            $baseFunc->setRedirectMessage(false, "参数错误", NULL);
            return redirect()->back();
        }
        DB::beginTransaction();
        $majorObj = new MajorConfig($major_id);
        $result = $majorObj->delete();
        if(false == $result){
            $baseFunc->setRedirectMessage(false, "删除失败", NULL);
            return redirect()->back();
        }
        //删除专业下的类型
        DB::commit();
        return redirect()->back();
    }

    /**
     * 管理员列表
     */
    public function sAdmin(){
        $param['role'] = 2;
        $data['arr'] = Admin::getAll(1,$param);
        return view("Teacher.AdminView.adminList", $data);
    }

    /**
     * 添加管理员
     */
    public function addAdmin(BaseFunc $baseFunc){
        if (!request::hasFile('pic')) {
            $baseFunc->setRedirectMessage(false, "错误，上传失败", NULL);
            return redirect()->back();
        }
        $file = Request::file('pic');
        $picId = Pic::addPic(3, $file);
        if(false == $picId){
            $baseFunc->setRedirectMessage(false, "错误，上传失败", NULL);
            return redirect()->back();
        }

        //判断是否已经存在相同管理员账号
        $inputData['admin_name'] =  $_POST['admin_name'];
        $result = Admin::findOne($inputData);
        if(false == empty($result)){
            $baseFunc->setRedirectMessage(false, "存在相同的管理员账号", NULL);
            return redirect()->back();
        }
        $inputData['pic_id'] = $picId;
        $inputData['id_number'] = $_POST['id_number'];
        $inputData['name'] = $_POST['name'];
        $inputData['number'] = $_POST['number'];
        $return = Admin::add($inputData);
        if($return == true) {
            $baseFunc->setRedirectMessage(true, "数据插入成功", NULL);
        } else {
            $baseFunc->setRedirectMessage(false, "数据插入失败", NULL);
        }
        return redirect()->back();
    }

    /**
     * 编辑管理员
     */
    public function editAdmin(BaseFunc $baseFunc){
        if (request::hasFile('pic')) {
            $file = Request::file('pic');
            $picId = Pic::addPic(3, $file);
            if(false == $picId){
                $baseFunc->setRedirectMessage(false, "错误，上传失败", NULL);
                return redirect()->back();
            }
            $inputData['pic_id'] = $picId;
        }
        //判断是否已经存在相同管理员账号
        $inputData['admin_name'] =  $_POST['admin_name'];
        $result = Admin::findOne($inputData);
        if(false == empty($result)){
            $baseFunc->setRedirectMessage(false, "存在相同的管理员账号", NULL);
            return redirect()->back();
        }
        $inputData['id_number'] = $_POST['id_number'];
        $inputData['name'] = $_POST['name'];
        $inputData['number'] = $_POST['number'];
        $adminObj = new Admin($_POST['id']);
        $return = $adminObj->update($inputData);
        if($return == true) {
            $baseFunc->setRedirectMessage(true, "数据修改成功", NULL);
        } else {
            $baseFunc->setRedirectMessage(false, "数据修改失败", NULL);
        }
        return redirect()->back();
    }

    /**
     * 删除管理员
     */
    public function deleteAdmin(BaseFunc $baseFunc, $id){
        if(true == empty($id)){
            $baseFunc->setRedirectMessage(false, "参数错误", NULL);
            return redirect()->back();
        }
        $adminObj = new Admin($id);
        $result = $adminObj->delete();
        if(false == $result){
            $baseFunc->setRedirectMessage(false, "删除失败", NULL);
        }
        return redirect()->back();
    }







}