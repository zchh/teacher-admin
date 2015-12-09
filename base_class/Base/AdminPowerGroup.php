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
}