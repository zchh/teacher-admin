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

class MajorConfig
{
    public $major_id;
    public $info;


    public function __construct($major_id){
        $this->major_id = $major_id;
        $this->syncBaseInfo();
    }

    public function syncBaseInfo(){
        $info = DB::table('t_major_config')->where('major_id','=',$this->major_id)->first();
        $this->info = $info;
        return $info;
    }

    //查找一条记录
    static function findOne($param){
        $result = null;
        $table = DB::table('t_major_config');
        if(false == empty($param['major_name'])){
            $result =  $table->where('major_name','=',$param['major_name'])->first();
        }
        return $result;
    }

    static function getAll($isPaginate=true, $paginateNumber=3){
        if(true == $isPaginate){
            $result = DB::table("t_major_config")
                ->orderBy("major_id","desc")
                ->paginate($paginateNumber);
        } else {
            $result = DB::table("t_major_config")
                ->get();
        }
        return $result;
    }

    static function add($arr){
        $id = DB::table("t_major_config")->insertGetId($arr);
        if(false == $id){
            return null;
        }
        return new MajorConfig($id);
    }

    public function update($arr){
        $result = DB::table('t_major_config')->where('major_id','=',$this->major_id)->update($arr);
        if(false == $result){
            return false;
        }
        $this->syncBaseInfo();
        return true;
    }

    public function delete(){
        $result =DB::table('t_major_config')->where('major_id','=',$this->major_id)->delete();
        return $result;
    }
}