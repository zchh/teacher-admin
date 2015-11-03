<?php
namespace GirdPlugins\Base;
use \Illuminate\Support\Facades\Session;
class UserPowerFunc
{
     /**
     * 用户权限获取
     * @access public
     * @param int $powerId
     * 
     *
     * @return Bool
     */
    public function getUserPower($userId)
    {
        /*$groupData = DB::table("base_user")->where("user_id","=",$userId)
                ->leftJoin("base_user_group","user_group","=","group_id")
                ->first();
        dump($groupData);
        $powerData = DB::table("base_user_re_power")->where("relation_group","=",$groupData->group_id)->get();
        $returnData=[];
        foreach($powerData as $data)
        {
            $returnData[]=$data->power;
        }
        dump($powerData);*/
        return NULL;
    
    }
        
     /**
     * 用户权限检查
     * 
     * 
     * @access public
     * @param power
     *
     * @return 若成功，返回用户信息，失败返回false；
     */
    public function checkUserPower()
    {
        return true;
    }
}