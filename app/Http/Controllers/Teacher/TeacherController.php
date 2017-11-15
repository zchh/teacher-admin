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
use BaseClass\Teacher\ClassConfig;
use BaseClass\Teacher\GradeConfig;
use BaseClass\Teacher\MajorConfig;
use BaseClass\Teacher\Student;
use BaseClass\Teacher\Teacher;
use BaseClass\Teacher\TeacherClass;
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
                $data['teacher_id'] = $result->teacher_id;
                $data['user_name'] = $result->name;
                session(["teacher" => $data]);
                $baseFunc->setRedirectMessage(true, "登陆成功", NULL, "/t_teacher_index");
            }else{
                $baseFunc->setRedirectMessage(false, "错误的用户名和密码", NULL, "/t_teacher_login");
                return redirect()->back();
            }
        }else{
            $baseFunc->setRedirectMessage(false, "错误的用户名和密码", NULL, "/t_teacher_login");
            return redirect()->back();
        }
    }

    /**
     * 首页
     */
    public function index(){
        return view("Teacher.TeacherView.index");
    }


    /**
     * 管理班级
     */
    public function adminClass(){
        session(["now_address"=>"/t_s_teacher"]);
        $teacherClassArr =  TeacherClass::getAll(1);
        $arr = array();
        foreach ($teacherClassArr as $teacherClass){
            $classConfig = new ClassConfig($teacherClass->class_id);
            $single['className'] = $classConfig->info->class_name;
            $arr[] = $single;
        }
        $data['arr'] = $arr;
        return view("Teacher.AdminView.teacherList", $data);
    }

    /**
     * 管理学生
     */
    public function adminStudent(){
        $param['teacher_id'] = session('teacher')['teacher_id'];
        $teacherClassArr = TeacherClass::getAll($param);
        $data['arr'] = $data['classArr'] =array();
        if(false == empty($teacherClassArr)){
                unset($param);
                $param['class_id'] = $teacherClassArr[0]->class_id;
                $data['arr'] = Student::getAll($param, 1);
            }
        foreach ($teacherClassArr as $single){
            $elem['class_id'] = $single->class_id;
            $class = new ClassConfig($elem);
            $elem['class_name'] = $class->info->class_name;
            $data['classArr'][] = $elem;
             unset($elem);
        }
        $data['gradeConfigArr'] = GradeConfig::getAll(false);
        $requestParam['class_id'] = null;
        $data['requestParam'] = $requestParam;
        return view("Teacher.TeacherView.studentList", $data);
    }

    /**
     * 按班级查找学生
     */
    public function getStudentByClass()
    {
        $requestParam['class_id'] = (false == empty($_POST['class_id']))?$_POST['class_id']:null;
        $param['teacher_id'] = session('teacher')['teacher_id'];
        $teacherClassArr = TeacherClass::getAll($param);
        $data['arr'] = $data['classArr'] =array();
        if(true == empty($requestParam['class_id'])){
            if(false == empty($teacherClassArr)){
                unset($param);
                $param['class_id'] = $teacherClassArr[0]->class_id;
                $data['arr'] = Student::getAll($param, 1);
            }
        }else{
            $data['arr'] = Student::getAll($requestParam, 1);
        }
        foreach ($teacherClassArr as $single){
            $elem['class_id'] = $single->class_id;
            $class = new ClassConfig($elem);
            $elem['class_name'] = $class->info->class_name;
            $data['classArr'][] = $elem;
            unset($elem);
        }
        $data['gradeConfigArr'] = GradeConfig::getAll(false);
        $data['requestParam'] = $requestParam;
        return view("Teacher.TeacherView.studentList", $data);
    }

    /**
     * 打分
     */
    public function makeGrade(){
        $gradeConfig = new GradeConfig($_POST['type_id']);
        $arr['type_id'] = $_POST['type_id'];


        $arr['type_name'] = $gradeConfig->info->type_name;
        $arr['grade'] = $_POST['grade'];


    }

    /**
     * 获取得扣分配置
     */
    public function getGradeConfig(){
        $data['arr'] = GradeConfig::getAll(false);
        return view("Teacher.TeacherView.gradeConfigList", $data);
    }

    /**
     * 增加得扣分配置
     */
    public function addGradeConfig(BaseFunc $baseFunc){
        $arr['type_name'] = $_POST['type_name'];
        $arr['grade'] = $_POST['grade'];
        $arr['teacher_id'] = session('teacher')['teacher_id'];
        $gradeConfig = GradeConfig::add($arr);
        if(true == empty($gradeConfig)){
            $baseFunc->setRedirectMessage(true, "登陆成功", NULL, NULL);
        }
        return redirect()->back();
    }

    /**
     * 编辑得扣分配置
     */
    public function editGradeConfig(BaseFunc $baseFunc){
        $arr['type_name'] = $_POST['type_name'];
        $arr['grade'] = $_POST['grade'];
        $gradeConfig = new GradeConfig($_POST['id']);
        $return = $gradeConfig->update($arr);
        if(false == $return){
            $baseFunc->setRedirectMessage(false, "编辑失败", NULL, NULL);
        }
        return redirect()->back();
    }

    /**
     * 删除得到扣分配置
     */
    public function deleteGradeConfig(BaseFunc $baseFunc, $grade_config_id){
        $gradeConfig = new GradeConfig($grade_config_id);
        $return = $gradeConfig->delete();
        if(false == $return){
            $baseFunc->setRedirectMessage(false, "删除失败", NULL, NULL);
        }
        return redirect()->back();
    }





}