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
        $info = DB::table('t_student')->where('t_student','=',$this->student_id)->first();
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

    static function getAll($paginateNumber){
        $result = DB::table("t_student")
            ->orderBy("student_id","desc")
            ->paginate($paginateNumber);
        return $result;
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