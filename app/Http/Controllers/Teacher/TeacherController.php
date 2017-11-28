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
use BaseClass\Teacher\GradeLog;
use BaseClass\Teacher\MajorConfig;
use BaseClass\Teacher\Student;
use BaseClass\Teacher\StudentGrade;
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
class TeacherController extends BaseController
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
     * 退出登录
     */
     public function teacherLoginOut(BaseFunc $baseFunc){
         Session::flush();
         $baseFunc->setRedirectMessage(true, "退出登出成功", NULL, "/t_teacher_login");
     }

    /**
     * 密码重置界面
     */
    public function teacherResetView(){
        $teacher = new Teacher(session('teacher')['teacher_id']);
        $data['teacher'] = $teacher->info;
        return view("Teacher.TeacherView.setting", $data);
    }

    /**
     * 密码重置
     */
    public function resetPassword(BaseFunc $baseFunc){
        $teacher = new Teacher(session('teacher')['teacher_id']);
        if($teacher->info->password != md5($_POST['oldPassword'])){
            $baseFunc->setRedirectMessage(false, "原密码输入错误", NULL, NULL);
            return redirect()->back();
        }
      if($_POST['newPassword1'] != $_POST['newPassword2']){
          $baseFunc->setRedirectMessage(false, "两次输入密码不一致", NULL, NULL);
          return redirect()->back();
      }
      $arr['password'] = md5($_POST['newPassword1']);
      $return = $teacher->update($arr);
      if(false == $return){
          $baseFunc->setRedirectMessage(false, "更新密码失败", NULL, NULL);
      }
      return redirect()->back();
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
            if(true == empty($classConfig->info)){
                continue;
            }
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
                $teacherClass = TeacherClass::findOne($param);
                $students = Student::getAll($param, 3);
                $this->setTempGrade($students, $teacherClass->id);

                $data['arr'] = Student::getAll($param, 3);
            }
        foreach ($teacherClassArr as $single){
            $elem['class_id'] = $single->class_id;
            $class = new ClassConfig($elem);
            if(true == empty($class->info)){
                continue;
            }
            $elem['class_name'] = $class->info->class_name;
            $data['classArr'][] = $elem;
             unset($elem);
        }
        $data['gradeConfigArr'] = GradeConfig::getAll(false);
        $requestParam['class_id'] = null;
        $requestParam['order'] = null;
        $requestParam['keywords'] = null;
        $data['requestParam'] = $requestParam;
        return view("Teacher.TeacherView.adminStudent", $data);
    }

    /**
     * 查找学生
     */
    public function getStudentByClass(){
        $requestParam['class_id'] = (false == empty($_REQUEST['class_id']))?$_REQUEST['class_id']:null;
        $requestParam['order'] = (false == empty($_REQUEST['order']))?$_REQUEST['order']:null;
        $requestParam['keywords'] = (false == empty($_REQUEST['keywords']))?$_REQUEST['keywords']:null;
        $param['teacher_id'] = session('teacher')['teacher_id'];
        $teacherClassArr = TeacherClass::getAll($param);
        $data['arr'] = $data['classArr'] =array();
        $param2['class_id'] = $requestParam['class_id'];
        $param2['teacher_id'] = session('teacher')['teacher_id'];
        $teacherClass = TeacherClass::findOne($param2);
        $students = Student::getAll($requestParam, 3);
        $this->setTempGrade($students, $teacherClass->id);
        $arr = Student::getAll($requestParam, 3);
        $arr -> setPath('t_get_student');
        $data['arr'] = $arr;
        foreach ($teacherClassArr as $single){
            $elem['class_id'] = $single->class_id;
            $class = new ClassConfig($elem);
            if(true == empty($class->info)){
                continue;
            }
            $elem['class_name'] = $class->info->class_name;
            $data['classArr'][] = $elem;
            unset($elem);
        };
        $data['gradeConfigArr'] = GradeConfig::getAll(false);
        $data['requestParam'] = $requestParam;
        return view("Teacher.TeacherView.adminStudent", $data);
    }

    //分数计算更新
    private function updateGrade($studentId, $teacherClassId, $grade){
             $param['student_id'] = $studentId;
             $param['teacher_class_id'] = $teacherClassId;
             $studentGrade = StudentGrade::findOne($param);
             $arr['grade'] = $studentGrade->grade + $grade;
             $studentGradeObj = new StudentGrade($studentGrade->id);
             $studentGradeObj->update($arr);
    }

    //存放临时分数
    private function setTempGrade($studentArr, $teacherClassId){
        foreach ($studentArr as $student){
            $student = new Student($student->student_id);
            $param['student_id'] = $student->student_id;
            $param['teacher_class_id'] = $teacherClassId;
            $studentGrade = StudentGrade::findOne($param);
            $arr['grade'] = $studentGrade->grade;
            $student->update($arr);
        }
    }

    /**
     * 打分
     */
    public function makeGrade(BaseFunc $baseFunc){
        $arr['type_id'] = $_POST['type_id'];
        $arr['student_id'] = $_POST['student_id'];
        $gradeConfig = new GradeConfig($_POST['type_id']);
        $arr['type_name'] = $gradeConfig->info->type_name;
        $arr['grade'] = $gradeConfig->info->grade;
        $student = new Student($_POST['student_id']);
        $param['class_id'] = $student->info->class_id;
        $param['teacher_id'] = $gradeConfig->info->teacher_id;
        $teacherClass = TeacherClass::findOne($param);
        if(true == empty($teacherClass)){
            $baseFunc->setRedirectMessage(false, "打分失败", NULL, NULL);
            return redirect()->back();
        }
        $arr['teacher_class_id'] = $teacherClass->id;
        $gradeLog = GradeLog::add($arr);
        if(true == empty($gradeLog)){
            $baseFunc->setRedirectMessage(false, "打分失败", NULL, NULL);
        }
        $this->updateGrade($_POST['student_id'], $teacherClass->id,  $arr['grade']);
        return redirect()->back();
    }

    /**
     * 对学生备注信息
     */
    public function makeStudentRemark(BaseFunc $baseFunc){
       $student = new Student($_POST['student_id']);
       $arr['remark'] = $_POST['remark'];
       $return = $student->update($arr);
       if(false == $return){
           $baseFunc->setRedirectMessage(false, "备注学生信息失败", NULL, NULL);
       }
        return redirect()->back();
    }

    /**
     * 获取得分记录
     */
    public function getGradeLog($student_id){
        $requestParam['student_id'] = $student_id;
        $student = new Student($student_id);

        $param['class_id'] = $student->info->class_id;
        $param['teacher_id'] = session('teacher')['teacher_id'];
        $teacherClass = TeacherClass::findOne($param);
        if(true == empty($teacherClass)){
            $this->alert("暂无数据");
        }
        $data['studentInfo']['course_name'] = $teacherClass->course_name;
        $requestParam['teacher_class_id'] = $teacherClass->id;
        $data['studentInfo']['student'] = $student->info;
        $data['arr'] = GradeLog::getAll($requestParam);
        $data['requestParam'] = array(
            'typeName' => '',
            'startDate' => '',
            'endDate' => '',
            'student_id' => $student_id );
        $data['types'] = GradeConfig::getAll(false);
        return view("Teacher.TeacherView.studentGradeLog", $data);
    }

    /**
     * 查询得分记录
     */
    public function sGradeLog(){
        $requestParam['typeName'] = (false == empty($_POST['typeName']))?$_POST['typeName']:null;
        $requestParam['startDate'] = (false == empty($_POST['startDate']))?$_POST['startDate']:null;
        $requestParam['endDate'] = (false == empty($_POST['endDate']))?$_POST['endDate']:null;
        $requestParam['student_id'] = (false == empty($_POST['student_id']))?$_POST['student_id']:null;
        $data['requestParam'] = $requestParam;
        $student = new Student( $requestParam['student_id']);
        $param['class_id'] = $student->info->class_id;
        $param['teacher_id'] = session('teacher')['teacher_id'];
        $teacherClass = TeacherClass::findOne($param);
        if(true == empty($teacherClass)){
            $this->alert("暂无数据");
        }
        $data['studentInfo']['student'] = $student->info;
        $requestParam['teacher_class_id'] = $teacherClass->id;
        $data['arr'] = GradeLog::getAll($requestParam);
        $data['studentInfo']['course_name'] = $teacherClass->course_name;
        $data['types'] = GradeConfig::getAll(false);
        return view("Teacher.TeacherView.studentGradeLog", $data);
    }

    /**
     * 学生成绩走势
     */
    public function studentGradeTrend($student_id){
        //基本信息：学生信息+课程名称
        $student = new Student($student_id);
        $data['baseInfo']['studentInfo'] = $student->info;
        $param['class_id'] = $student->info->class_id;
        $param['teacher_id'] = session('teacher')['teacher_id'];
        $teacherClass = TeacherClass::findOne($param);
        if(true == empty($teacherClass)){
            $this->alert("暂无数据");
            return view("Teacher.TeacherView.studentGradeTrend", $data);
        }
        $data['baseInfo']['courseName'] = $teacherClass->course_name;
        //时间数组，成绩数组
        unset($param);
        $param['student_id'] = $student_id;
        $param['teacher_class_id'] = $teacherClass->id;
        $arr['gradeArr'] = $arr['periodArr'] = array();
        for($i = 15 ; $i >0 ; $i --){
            $today = (string)date("Y-m-d",strtotime('-'.$i.' day'));
            $j = $i-1;
            if($j == 0){
                $tomorrow = (string)date("Y-m-d");
            } else {
                $tomorrow = (string)date("Y-m-d",strtotime('-'.$j.' day'));
            }
            $param['endDate'] = $tomorrow;
            $gradeLogs = GradeLog::findAll($param);
            $grade = 0;
            foreach ($gradeLogs as $gradeLog){
                $grade += $gradeLog->grade;
            }
            array_push($arr['gradeArr'], $grade);
            array_push($arr['periodArr'], $today);
        }
        $data['arr'] = json_encode($arr);
        return view("Teacher.TeacherView.studentGradeTrend", $data);
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