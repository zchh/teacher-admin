<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 16:50
 */


namespace BaseClass\Test\Controllers\Admin;
use BaseClass\Base\AdminPowerGroup;
use BaseClass\Role\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class AdminPowerTest extends Controller
{
    //测试构造函数，创建用户的函数
    public function addTest()
    {
        $group_name= "zhangchi";
        $a= AdminPowerGroup::add($group_name);
        dump($a);
    }

    //测试增加权限
    public function addPowerTest()
    {
        $power_id=3;
        $a=new AdminPowerGroup(2);
        $a->addPower($power_id);
        $b=DB::table("base_admin_re_power")
            ->where("relation_group_id","=","2")
            ->get();
        dump($b);
    }
    //测试删除权限
    public function removePowerTest()
    {
        $power_id=3;
        $a=new AdminPowerGroup(2);
        $a->removePower($power_id);
        $b=DB::table("base_admin_re_power")
            ->where("relation_group_id","=",2)
            ->get();
        dump($b);

    }

    //测试增加用户  ,详细信息未添加进去
    public function addAdminTest()
    {
        $admin_id=3;
        $a=new AdminPowerGroup(1);
        $a->addAdmin($admin_id);
        $b=DB::table("base_admin")
            ->where("admin_id","=",$admin_id)
            ->get();
        dump($b);
    }

    //测试移除管理员
    public function removeAdminTest()
    {
        $admin_id=3;
        $a=new AdminPowerGroup(2);
        $a->removeAdmin($admin_id);
        $b=DB::table("base_admin")
            ->where("admin_id","=",$admin_id)
            ->get();
        dump($b);

    }

    //测试删除权限组
    public function deleteTest()
    {
        $a=new AdminPowerGroup(2);
        $a->delete();
        $b=DB::table("base_admin_group")
            ->get();
        dump($b);
    }

    public function AdminController()
    {

       $a =new Admin(1);
       // $a ->delete();
        dump($a);
    }
    public function getAdminPower()
    {
        $a =new Admin(1);
        $data = $a ->getAdminPower();
        dump($data);

    }
}