<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 16:06
 */

namespace BaseClass\Base;
use Illuminate\Support\Facades\DB;



class UserPowerGroup
{
    /**
     * @var
     */
    private $power_list;
    /**
     * @var
     */
    private $user_list;
    /**
     * @var
     */
    private $info;

    private $group_id;

    //创建一个用户组
    /**
     * @param $group_name
     * @return UserPowerGroup|bool
     */
    static function  add($group_name)
    {
        $groupExisted=DB::table("base_user_group")
            ->where("group_name","=","$group_name")
            ->pluck("group_name");
        if($groupExisted!=null){return false;};
        $group_id=DB::table("base_user_group")
            ->insertGetId(["group_name"=>"$group_name"]);
        return new UserPowerGroup($group_id);

    }


    //
    /**
     * 构造函数
     * @param $group_id
     */
    public function __construct($group_id)
    {
        $this->group_id = $group_id;
         $this->syncBaseInfo($group_id);

    }


    //构造函数应该从此函数中获取数据
    /**
     * @param $group_id
     * @return bool
     */
    public function syncBaseInfo()
    {
        $group_id = $this->group_id;

        if(DB::table("base_user_group")->where("group_id",$group_id)->first() == NULL)
        {
            return false;
        }

        //拿到权限
       $powerData= DB::table("base_user_re_power")
            ->where("relation_id","=","$group_id")
            ->get();

        foreach ($powerData as $value)
        {
            $this->power_list[] = $value->relation_power;
        }

        //拿到用户
        $userData=DB::table("base_user")
            ->where("user_group","=","$group_id")
            ->get();
        foreach($userData as $Data)
        {
            $this->user_list[] = $Data->user_id;
        }

        //拿到基本信息
        $this->info =DB::table("base_user_group")
            ->where("group_id","=","$group_id")
            ->first();

    }

    //添加一个权限
    /**
     * @param $power_id
     * @return bool
     */
    public function addPower($power_id)

    {

        $relationExisted=DB::table("base_user_re_power")
            ->where("relation_power","=",$power_id)
            ->where("relation_group","=",$this->info->group_id)
            ->get();
        if($relationExisted!=null){return false;}
        $relation["relation_power"]=$power_id;
        $relation["relation_group"]=$this->info->group_id;
        DB::table("base_user_re_power")->insert($relation);
        $this->syncBaseInfo();
    }
    //删除一个权限
    /**
     * @param $power_id
     */
    public function removePower($power_id)
    {
        DB::table("base_user_re_power")
            ->where("relation_power","=","$power_id")
            ->where("relation_group","=",$this->info->group_id)
            ->delete();
        $this->syncBaseInfo();
    }

    //增加一个用户
    /**
     * @param $user_id
     * @return bool
     */
    public function addUser($user_id)
    {
        $userExisted=DB::table("base_user")
            ->where("user_id","=","$user_id")
            ->pluck("user_group");
        if($userExisted!=null){return false;}
        DB::table("base_user")
            ->where("user_id","=","$user_id")
            ->update(["user_group"=>$this->info->group_id]);
        $this->syncBaseInfo();
    }

    //删除一个用户
    /**
     * @param $user_id
     */
    public function removeUser($user_id)
    {
        $userData=DB::table("base_user")
            ->where("user_id","=","$user_id")
            ->get();

        DB::table("base_user")
            ->where("user_id","=","$user_id")
            ->update(["user_group"=>null]);
        $this->syncBaseInfo();
    }

    //删除这个用户组
    /**
     *
     */
    public function delete()
    {
        DB::table("base_user_group")
            ->where("group_id","=",$this->info->group_id)
            ->delete();

    }
}