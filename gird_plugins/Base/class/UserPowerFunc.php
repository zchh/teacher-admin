<?php
namespace GirdPlugins\Base;
use \Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class UserPowerFunc
{
     /**
     * 用户权限获取
     * @access public
     * @param int $powerId
     * @return Bool
     */
    public function getUserPower($userId)
    {
        $groupData = DB::table("base_user")->where("user_id","=",$userId)->first();
        
        $powerData = DB::table("base_user_re_power")->where("relation_group","=",$groupData->user_group)->get();
        
        $returnData=[];
        foreach($powerData as $data)
        {
            $returnData[]=$data->relation_power;
        }
        //dump($returnData);
        return $returnData;
    
    }
        
     /**
     * 用户权限检查
     * 
     * 
     * @access public
     * @param int $powerId 权限id
     *
    * @return bool；
     */
    public function checkUserPower($powerId)
    {
        $powerData = session("user.user_power");
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
