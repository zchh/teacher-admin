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

class Teacher
{
    public $teacher_id;
    public $info;


    public function __construct($teacher_id){
        $this->teacher_id = $teacher_id;
        $this->syncBaseInfo();
    }

    public function syncBaseInfo(){
        $info = DB::table('t_teacher')->where('teacher_id','=',$this->teacher_id)->first();
        $this->info = $info;
        return $info;
    }

    /**
     * @param $query_limit
     * @return array
     */
    static function select($query_limit)
    {
        $query = DB::table("t_teacher")->orderBy('teacher_id',"desc");

        //计算出总条数
        $num_query  = clone $query;//克隆出来不适用原来的对象
        $return_data["total"] = $num_query->select(DB::raw('count(*) as num'))->first()->num  ;

        //起始条数
        if ( isset($query_limit["start"]) ) {
            $query = $query->skip($query_limit["start"]);
        }

        //每页条数
        if(isset($query_limit["num"])) {
            if($query_limit["num"]==0){
                $return_data["status"] = true;
                $return_data["message"] = "查询到数据,但num设为了0";
                $return_data["data"] =  null;
                return $return_data;
            }
            $query = $query->take($query_limit["num"]);
        } else {
            $query = $query->take(config("my_config.default_num_page"));
        }
        $return_data["status"] = true;
        $return_data["message"] = "成功获取到数据";
        $return_data["data"] =  $query->get();
        return $return_data;
    }

    //查找一条记录
    static function findOne($param){
        $result = null;
        $table = DB::table('t_teacher');
        if(false == empty($param['user_name'])){
            $result =  $table->where('user_name','=',$param['user_name'])->first();
        }
        if(false == empty($param['password'])){
            $result =  $table->where('password','=',$param['password'])->first();
        }
        if(false == empty($param['user_name'])){
            $result =  $table->where('user_name','=',$param['user_name'])->first();
        }
        return $result;
    }

    //查找多条记录
    static function findAll($param){
        $result = null;
        $table = DB::table('t_teacher');
        if(false == empty($param['user_name'])){
            $result =  $table->where('user_name','=',$param['user_name']);
        }
        if(false == empty($param['password'])){
            $result =  $table->where('password','=',$param['password']);
        }
        if(false == empty($param['user_name'])){
            $result =  $table->where('user_name','=',$param['user_name']);
        }
        return $result->get();
    }


    static function getAll($paginateNumber){
        $result = DB::table("t_teacher")
            ->orderBy("teacher_id","desc")
            ->paginate($paginateNumber);
        return $result;
    }

    static function add($arr){
        $arr['create_time'] = new \DateTime('now');
        $id = DB::table("t_teacher")->insertGetId($arr);
        if(false == $id){
            return null;
        }
        return new Teacher($id);
    }

    public function update($arr){
        $result = DB::table('t_teacher')->where('teacher_id','=',$this->teacher_id)->update($arr);
        if(false == $result){
            return false;
        }
        $this->syncBaseInfo();
        return true;
    }

    public function delete(){
        $result =DB::table('t_teacher')->where('teacher_id','=',$this->teacher_id)->delete();
        return $result;
    }
}