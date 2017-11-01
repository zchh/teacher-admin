<?php
/**
 * Created by PhpStorm.
 * User: 57156
 * Date: 2017/11/1
 * Time: 15:06
 */

namespace BaseClass\Teacher;
use Illuminate\Support\Facades\DB;

class Admin
{
    public $id;
    public $info;


    public function __construct($id){
        $this->id = $id;
    }

    public function syncBaseInfo(){
        $info = DB::table('t_admin')->where('id','=',$this->id)->first();
        $this->info = $info;
        return $info;
    }

    /**
     * @param $query_limit
     * @return array
     */
    static function select($query_limit)
    {
        $query = DB::table("t_admin")->orderBy('id',"desc");

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
       if(false == empty($param['admin_name'])){
           $result =  DB::table('t_admin')->where('admin_name','=',$param['admin_name'])->first();
       }
       if(false == empty($param['password'])){
           $result =  DB::table('t_admin')->where('password','=',$param['password'])->first();
       }
       return $result;
    }

    public function add($arr){
        $id = DB::table("t_admin")->insertGetId($arr);
        if(false == $id){
            return false;
        }
        return new Admin($id);
    }

    public function update($arr){
        $result = DB::table('t_admin')->where('id','=',$this->id)->update($arr);
        if(false == $result){
            return false;
        }
        $this->syncBaseInfo();
        return true;
    }

    public function delete(){
        $result =DB::table('t_admin')->where('id','=',$this->id)->delete();
        if(false == empty($result)){
            return false;
        }
        return true;
    }
}