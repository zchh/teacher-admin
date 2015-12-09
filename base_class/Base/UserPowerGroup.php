<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 16:06
 */

namespace BaseClass\Base;

class UserPowerGroup
{
    private $power_list;


    static function  add()
    {}


    //����Ȩ��������ʼ��
    public function __construct($group_id)
    {

    }


    //��ʼ����Ϣ�����캯��Ӧ��ͨ�����������ȡ����Ϣ
    public function syncBaseInfo($group_id)
    {

    }

    //���һ��Ȩ�޵�����
    public function addPower($power_id)
    {

    }
    //ɾ��һ��Ȩ��
    public function removePower($power_id)
    {

    }

    //���һ����Ա
    public function addUser($user_id)
    {

    }

    //ɾ��һ����Ա
    public function removeUser($user_id)
    {

    }

    //����Ȩ������Ϣ
    public function updateInfo($info_array)
    {

    }
    public function delete()
    {

    }

    /**
     * 用户权限获取
     * @access public
     * @return Bool
     */
    public function loadUserPowerToSession()
    {


        $powerData = DB::table("base_user_re_power")->where("relation_group","=",$this->info->group_id)->get();

        $returnData=[];
        foreach($powerData as $data)
        {
            $returnData[]=$data->relation_power;
        }


        Session::push('user.user_power', $returnData);


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
    static function checkUserPower($powerId)
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