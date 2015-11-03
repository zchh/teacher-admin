<?php
namespace GirdPlugins\Base;
use \Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
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
         $groupData = DB::table("base_admin")->where("admin_id","=",$adminId)->first();
        //dump($groupData);
        $powerData = DB::table("base_admin_re_power")->where("relation_group_id","=",$groupData->admin_group)->get();
        //dump($powerData);
        $returnData=[];
        foreach($powerData as $data)
        {
            $returnData[] = $data->relation_power_id;
        }
        //dump($returnData);
        return $returnData;
    }

     /**
     * 管理员权限检查
     * 
     * 
     * @access public
     * @param int powerId 权限ID
     *
     * @return 若成功，返回用户信息，失败返回false；
     */
    public function checkAdminPower($powerId)
    {
        $powerData = session("admin.admin_power");
        if($powerData == NULL)
        {
            return false;
        }
        foreach($powerData as $data)
        {
            if($data == $powerId)
            {
                return true;
            }
        }
        return false;
    }
    
}
?>