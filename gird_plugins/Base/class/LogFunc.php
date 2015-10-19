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
  
}
?>
