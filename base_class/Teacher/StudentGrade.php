<?php
/**
 * Created by PhpStorm.
 * User: 57156
 * Date: 2017/11/1
 * Time: 15:06
 */

namespace BaseClass\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class StudentGrade
{
    public $id;
    public $info;


    public function __construct($id){
        $this->id = $id;
        $this->syncBaseInfo();
    }

    public function syncBaseInfo(){
        $info = DB::table('t_student_grade')->where('id','=',$this->id)->first();
        $this->info = $info;
        return $info;
    }

    //查找一条记录
    static function findOne($param){

        $result = DB::table('t_student_grade');
        return $result->first();
    }

    //查找多条记录
    static function findAll($param){
        $result = DB::table('t_student_grade');
        if(false == empty($param['student_id'])){
            $result = $result->where('student_id','=',$param['student_id']);
        }
        if(false == empty($param['teacher_class_id'])){
            $result = $result->where('teacher_class_id','=',$param['teacher_class_id']);
        }
        return $result->get();
    }


    static function getAll($param=[]){
        $result = DB::table("t_student_grade");
        if(false == empty($param['student_id'])){
            $result = $result->where('student_id','=',$param['student_id']);
        }
        if(false == empty($param['teacher_class_id'])){
            $result = $result->where('teacher_class_id','=',$param['teacher_class_id']);
        }
        return $result->get();
    }

    static function add($arr){
        $id = DB::table("t_student_grade")->insertGetId($arr);
        if(false == $id){
            return null;
        }
        return new StudentGrade($id);
    }

    static function init($student_id, $teacher_class_id){
        $arr['student_id'] = $student_id;
        $arr['teacher_class_id'] = $teacher_class_id;
        $arr['grade'] = 0;
        $id = DB::table("t_student_grade")->insertGetId($arr);
        if(false == $id){
            return null;
        }
        return new StudentGrade($id);
    }

    public function update($arr){
        $result = DB::table('t_student_grade')->where('id','=',$this->id)->update($arr);
        if(false == $result){
            return false;
        }
        $this->syncBaseInfo();
        return true;
    }

    public function delete(){
        $result =DB::table('t_student_grade')->where('id','=',$this->id)->delete();
        return $result;
    }
}