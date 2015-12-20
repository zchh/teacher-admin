<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 16:12
 */

namespace BaseClass\Base;


class AdminPowerGroup
{

    private $power_list;


    static function  add()
    {}

    //按照权限组来初始化
    public function __construct($group_id)
    {

    }

    //初始化信息，构造函数应该通过这个函数获取到信息
    public function syncBaseInfo($group_id)
    {

    }


    //添加一个权限到该组
    public function addPower($power_id)
    {

    }
    //删除一个权限
    public function removePower($power_id)
    {

    }

    //添加一个人员
    public function addUser($admin_id)
    {

    }

    //删除一个人员
    public function removeUser($admin_id)
    {

    }

    //更新权限组信息
    public function updateInfo($info_array)
    {

    }
    public function delete()
    {

    }


    /**
     * 管理员权限获取
     *
     *
     * @access public
     * @return Array 返回权限数组
     */
    public function loadAdminPowerToSession()
    {

        $powerData = DB::table("base_admin_re_power")->where("relation_group_id","=",$this->info->group_id)->get();
        //dump($powerData);
        $returnData=[];
        foreach($powerData as $data)
        {
            $returnData[] = $data->relation_power_id;
        }
        Session::push('admin.admin_power', $returnData);


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
    static function checkAdminPower($powerId)
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