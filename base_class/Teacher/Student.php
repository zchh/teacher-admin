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

class Student
{
    public $student_id;
    public $info;


    public function __construct($student_id){
        $this->student_id = $student_id;
        $this->syncBaseInfo();
    }

    public function syncBaseInfo(){
        $info = DB::table('t_student')->where('student_id','=',$this->student_id)->first();
        $this->info = $info;
        return $info;
    }

    //查找一条记录
    static function findOne($param){
        $result = null;
        $table = DB::table('t_student');
        if(false == empty($param['student_number'])){
            $result =  $table->where('student_number','=',$param['student_number'])->first();
        }
        return $result;
    }

    static function findAll($param){
        $result = null;
        $table = DB::table('t_student');
        if(false == empty($param['student_number'])){
            $result =  $table->where('student_number','=',$param['student_number'])->get();
        }
        return $result;
    }

    static function getAll($param=[], $paginateNumber){
        $table = DB::table("t_student");
        $result = array();
        if(true == empty($param)){
            $result = $table->orderBy("student_id","desc")
                ->paginate($paginateNumber);
        }else{
            if(false == empty($param['class_id'])){
                $result = $table->where('class_id','=',$param['class_id']);
            }
        }
        if(false == empty($param['keywords'])){
            $result->where('student_number', 'like', '%'.$param['keywords'].'%')->orWhere('name', 'like', '%'.$param['keywords'].'%');
        }
        if(false == empty($param['order'])){
            if($param['order'] == '1'){
                $result->orderBy('grade','asc');
            }
            if($param['order'] == '2'){
                $result->orderBy('grade','desc');
            }
            if($param['order'] == '3'){
                $result->orderBy('student_number','asc');
            }
        }
        return $result->paginate($paginateNumber);
    }

    static function add($arr){
        $arr['create_time'] = new \DateTime('now');
        $id = DB::table("t_student")->insertGetId($arr);
        if(false == $id){
            return null;
        }
        return new Teacher($id);
    }

    public function update($arr){
        $result = DB::table('t_student')->where('student_id','=',$this->student_id)->update($arr);
        if(false == $result){
            return false;
        }
        $this->syncBaseInfo();
        return true;
    }

    public function delete(){
        $result =DB::table('t_student')->where('student_id','=',$this->student_id)->delete();
        return $result;
    }
}