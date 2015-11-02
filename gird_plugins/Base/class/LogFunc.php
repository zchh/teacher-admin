<?php
namespace GirdPlugins\Base;
use \Illuminate\Support\Facades\Session;
class LogFunc
{
     /**
     * 写入记录
     * @access public
     * @param array $log_array
        
     * @return Bool (成功/失败)
      * $log_array["log_level"]=记录危险等级，越高越轻微，判定方式错误表
         $log_array["log_title"]=记录标题
         $log_array["log_detail"]=记录详细信息
         $log_array["log_data"]=记录数据
         $log_array["log_user"]=记录操作用户
         $log_array["log_admin"]=记录操作管理员
      * 
     */
    public function AddLog($log_array)
    {
        
        
    }
    public function GetAllLog()
    {
        
    }
    public function GetLogByAdmin($adminId)
    {
        
    }
    public function GetLogByUser($userId)
    {
        
    }
    
    /*
     * 记录插入函数，操作base_log表
     * 使用者需要传入一个数组，数组的键包括除log_id以外的其他字段，按顺序写
     * $log_array["log_level"]=记录危险等级，越高越轻微，判定方式错误表
         $log_array["log_title"]=记录标题
         $log_array["log_detail"]=记录详细信息
         $log_array["log_data"]=记录数据
         $log_array["log_user"]=记录操作用户
         $log_array["log_admin"]=记录操作管理员
     * 返回值为bool值，成功返true，失败返false
     * 
     */
    
     public function insertLog($log_array) { //zc

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
     * 成功返回base_log表的一条记录
     * 失败返回null
     */
    public function selectLogByUser($log_user) {             //zc
        //连接base_user表和base_log表
        $record = DB::table("base_log")->where('log_user', '=', $log_user)->first();
        if($record == null)
        {
            return null;
        }
        else 
        {
            return $record;  //返回一条记录
        }
        
    
    }
    
    
     /*
     * 基于管理员id去查记录,使用者需传入$log_user(用户id)
     * 操作base_log表
     * 成功返回base_log表的一条记录
     * 失败返回null
     */
    public function selectLogByAdmin($log_admin) {
        
         //连接base_user表和base_log表
        $record = DB::table("base_log")->where('log_admin', '=',$log_admin)->first();
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

