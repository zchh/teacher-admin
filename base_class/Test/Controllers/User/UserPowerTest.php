<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 16:50
 */


namespace BaseClass\Test\Controllers\User;
use BaseClass\Base\UserPowerGroup;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class UserTest extends Controller
{
    //测试构造函数，创建用户的函数
    public function addTest()
    {
        $group_name=1;
        $a= UserPowerGroup::add($group_name);
        dump($a);
    }

    //测试增加权限
    public function addPowerTest()
    {
        $power_id=1;
        $a=new UserPowerGroup(2);
        $a->addPower($power_id);
        $b=DB::table("base_user_re_power")
            ->where("relation_group","=","2")
            ->get();
        dump($b);

    }
    //测试删除权限
    public function removePowerTest()
    {
        $power_id=1;
        $a=new UserPowerGroup(2);
        $a->removePower($power_id);
        $b=DB::table("base_user_re_power")
            ->where("relation_group","=","2")
            ->get();
        dump($b);

    }

    //测试增加用户
    public function addUserTest()
    {
        $user_id=11;
        $a=new UserPowerGroup(2);
        $a->addUser($user_id);
        $b=DB::table("base_user")
            ->where("user_id","=","$user_id")
            ->get();
        dump($b);
    }

    //测试删除用户
    public function removerUserTest()
    {
        $user_id=11;
        $a=new UserPowerGroup(2);
        $a->removeUser($user_id);
        $b=DB::table("base_user")
        ->where("user_id","=","$user_id")
        ->get();
        dump($b);

    }

    //测试删除权限组
        public function deleteTest()
    {
        $a=new UserPowerGroup(2);
        $a->delete();
        $b=DB::table("base_user_group")
            ->get();
        dump($b);
    }
}