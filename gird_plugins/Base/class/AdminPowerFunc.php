<?php
namespace GirdPlugins\Base;
use \Illuminate\Support\Facades\Session;
class AdminPowerFunc
{
     /**
     * 管理员权限获取
     * 
     * 
     * @access public
     * @param int $userId
     * 
     *
     * @return Array 返回权限数组
     */
    public function getAdminPower($adminId)
    {
        return NULL;
    }

     /**
     * 管理员权限检查
     * 
     * 
     * @access public
     * @param string $user_name 用户名
     * @param string $password 密码
     *
     * @return 若成功，返回用户信息，失败返回false；
     */
    public function checkAdminPower()
    {
        return true;
    }
    
}
?>