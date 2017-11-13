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

class TeacherClass
{
    public $id;
    public $info;


    public function __construct($id){
        $this->id = $id;
        $this->syncBaseInfo();
    }

    public function syncBaseInfo(){
        $info = DB::table('t_teacher_class')->where('id','=',$this->id)->first();
        $this->info = $info;
        return $info;
    }

    //查找一条记录
    static function findOne($param){
        $result = null;
        $table = DB::table('t_teacher_class');
        if(false == empty($param['teacher_id'])){
            $result =  $table->where('teacher_id','=',$param['teacher_id'])->first();
        }
        return $result;
    }

    static function getAll($param=[]){
        $table = DB::table("t_teacher_class");
        $result = [];
        if(false == empty($param['teacher_id'])){
            $result = $table->where('teacher_id','=',$param['teacher_id'])->get();
        }
        return $result;
    }

    static function add($arr){
        $id = DB::table("t_teacher_class")->insertGetId($arr);
        if(false == $id){
            return null;
        }
        return new TeacherClass($id);
    }

    public function update($arr){
        $result = DB::table('t_teacher_class')->where('id','=',$this->id)->update($arr);
        if(false == $result){
            return false;
        }
        $this->syncBaseInfo();
        return true;
    }

    public function delete(){
        $result =DB::table('t_teacher_class')->where('id','=',$this->id)->delete();
        return $result;
    }
}