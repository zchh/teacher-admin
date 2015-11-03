<?php
namespace GirdPlugins\Base;
use \Illuminate\Support\Facades\Session;
class LogFunc
{
        
    /* 
     * @access public
     * 记录插入函数，操作base_log表
     * 使用者需要传入一个数组，数组的键包括除log_id以外的其他字段，按顺序写
     * @param $log_array
     *   $log_array["log_level"]=记录危险等级，越高越轻微，判定方式错误表
     *   $log_array["log_title"]=记录标题
         $log_array["log_detail"]=记录详细信息
         $log_array["log_data"]=记录数据
         $log_array["log_user"]=记录操作用户
         $log_array["log_admin"]=记录操作管理员
     * @return 返回值为bool值，成功返true，失败返false
     * 
     */
    
     public function addLog($log_array) { //zc

         $insert = DB::table('base_log')->insert($log_array);
         if($insert)
         {
             return true;
         }
         else 
         {
             return false;
         }
       
    }

    /*
     * 基于用户id去查记录,使用者需传入$log_user(用户id)
     * 操作base_log表
     * 成功返回base_log表关于该用户的记录
     * 失败返回null
     */
    public function selectLogByUser($log_user) {             //zc
        //连接base_user表和base_log表
        $record = DB::table("base_log")->where('log_user', '=', $log_user)->get();
        if($record == null)
        {
            return null;
        }
        else 
        {
            return $record;  //返回该用户所有记录
        }
        
    
    }
    
    
     /*
     * 基于管理员id去查记录,使用者需传入$log_user(用户id)
     * 操作base_log表
     * 成功返回base_log表的该管理员记录
     * 失败返回null
     */
    public function selectLogByAdmin($log_admin) {
        
         //连接base_user表和base_log表
        $record = DB::table("base_log")->where('log_admin', '=',$log_admin)->get();
        if($record == null)
        {
            return null;
        }
        else
        {
            return $record;  //返回一条记录
        }
        
        
        
        
    }
  
}

