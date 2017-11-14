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

class GradeConfig
{
    public $type_id;
    public $info;


    public function __construct($type_id){
        $this->type_id = $type_id;
        $this->syncBaseInfo();
    }

    public function syncBaseInfo(){
        $info = DB::table('t_grade_config')->where('type_id','=',$this->type_id)->first();
        $this->info = $info;
        return $info;
    }

    //查找一条记录
//    static function findOne($param){
//        $result = null;
//        $table = DB::table('t_grade_config');
//        if(false == empty($param['class_name'])){
//            $result =  $table->where('class_name','=',$param['class_name'])->first();
//        }
//        return $result;
//    }

    static function getAll($isPaginate=true ,$paginateNumber=1){
        if(true == $isPaginate){
            $result = DB::table("t_grade_config")
                ->orderBy("type_id","desc")
                ->paginate($paginateNumber);
        } else {
            $result = DB::table("t_grade_config")
                ->orderBy("type_id","desc")
                ->get();
        }
        return $result;
    }

    static function add($arr){
        $id = DB::table("t_grade_config")->insertGetId($arr);
        if(false == $id){
            return null;
        }
        return new GradeConfig($id);
    }

    public function update($arr){
        $result = DB::table('t_grade_config')->where('type_id','=',$this->type_id)->update($arr);
        if(false == $result){
            return false;
        }
        $this->syncBaseInfo();
        return true;
    }

    public function delete(){
        $result =DB::table('t_grade_config')->where('type_id','=',$this->type_id)->delete();
        return $result;
    }
}