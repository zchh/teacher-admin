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

class GradeLog
{
    public $id;
    public $info;


    public function __construct($id){
        $this->id = $id;
        $this->syncBaseInfo();
    }

    public function syncBaseInfo(){
        $info = DB::table('t_grade_log')->where('id','=',$this->id)->first();
        $this->info = $info;
        return $info;
    }

    //查找一条记录
    static function findOne($param){
        $result = null;
        $table = DB::table('t_grade_log');
        if(false == empty($param['student_id'])){
            $result =  $table->where('student_id','=',$param['student_id']);
        }
        return $result->first();
    }

    //查找多条记录
    static function findAll($param){
        $result = null;
        $table = DB::table('t_grade_log');
        if(false == empty($param['student_id'])){
            $result =  $table->where('student_id','=',$param['student_id']);
        }
        return $result->get();
    }


    static function getAll($param=[]){
        $table = DB::table("t_grade_log");
        $result = [];
        if(false == empty($param['student_id'])){
            $result = $table->where('student_id','=',$param['student_id']);
        }
        return $result->get();
    }

    static function add($arr){
        $arr['create_time'] = new \DateTime('now');
        $id = DB::table("t_grade_log")->insertGetId($arr);
        if(false == $id){
            return null;
        }
        return new GradeLog($id);
    }

    public function update($arr){
        $result = DB::table('t_grade_log')->where('id','=',$this->id)->update($arr);
        if(false == $result){
            return false;
        }
        $this->syncBaseInfo();
        return true;
    }

    public function delete(){
        $result =DB::table('t_grade_log')->where('id','=',$this->id)->delete();
        return $result;
    }
}