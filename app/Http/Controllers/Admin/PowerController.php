<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PowerController extends Controller {

    public function sAdmin() 
    {
        session(["now_address" => "/admin_sAdmin"]);
        $data['articleData'] = DB::table("base_admin")->leftJoin("base_admin_group", "admin_group", "=", "group_id")->paginate(5);
        $data['groupData'] = DB::table("base_admin_group")->get();
        return view("Admin.Power.sAdmin", $data);
    }

    public function aAdmin() 
    {
        return view("Admin.Power.aAdmin");
    }

    public function _aAdmin(BaseFunc $baseFunc) 
    {
        $input = Request::only('admin_username', 'admin_nickname', 'admin_password','admin_group');
        $input["admin_password"] = md5('admin_password');
        DB::table("base_admin")->insert($input);
        $baseFunc->setRedirectMessage(true, "添加管理员用户成功！", NULL, "/admin_sAdmin");
    }

    /*public function moreAdmin($admin_id)
    {
        $data["AdminData"] = DB::table("base_admin")->where("admin_id", "=", $admin_id)->get();
        $data["GroupData"] = DB::table("base_admin_group")->get();
        $data["GroupPowerData"] = DB::table("base_admin_re_power")->get();
        return view("Admin.Power.moreAdmin", $data);
    }*/

    public function uAdmin(BaseFunc $baseFunc)
    {
        $adminId = Request::input('admin_id');
        $adminUserName = Request::input("admin_username");
        $adminNickName = Request::input("admin_nickname");
        $adminGroup = Request::input("admin_group");
        DB::table("base_admin")->where("admin_id", "=", $adminId)->update([
            "admin_username" => $adminUserName,
            "admin_nickname" => $adminNickName,
            "admin_group" => $adminGroup
        ]);
        $baseFunc->setRedirectMessage(true, "修改管理员用户信息成功！", NULL, "/admin_sAdmin");
    }

    public function dAdmin(BaseFunc $baseFunc, $admin_id)
    {
        DB::table("base_admin")->where("admin_id", "=", $admin_id)->delete();
        $baseFunc->setRedirectMessage(true, "删除管理员用户成功！", NULL, "/admin_sAdmin");
    }

    public function sAdminPowerGroup()
    {

        session(["now_address" => "/admin_sAdminPowerGroup"]);

        $data["GroupData"] = DB::table("base_admin_group")->paginate(5);
        return view("Admin.Power.sAdminPowerGroup", $data);
    }

    public function aAdminPowerGroup() 
    {
        return view("Admin.Power.aAdminPowerGroup");
    }

    public function _aAdminPowerGroup(BaseFunc $baseFunc)
    {
        $input = Request::only('group_name');
        DB::table("base_admin_group")->insert($input);
        $baseFunc->setRedirectMessage(true, "添加权限组成功！", NULL, "/admin_sAdminPowerGroup");
    }

    public function uAdminPowerGroup(BaseFunc $baseFunc)
    {
        $groupId = Request::input('group_id');
        $groupName = Request::input("group_name");
        DB::table("base_admin_group")->where("group_id", "=", $groupId)->update(["group_name" => $groupName]);
        $baseFunc->setRedirectMessage(true, "修改权限组名称成功！", NULL, "/admin_sAdminPowerGroup");
    }

    public function dAdminPowerGroup(BaseFunc $baseFunc, $group_id)
    {
        DB::table("base_admin_group")->where("group_id", "=", $group_id)->delete();
        $baseFunc->setRedirectMessage(true, "删除权限组成功！", NULL, "/admin_sAdminPowerGroup");
    }

    public function moreAdminPowerGroup($group_id)
    {
        $data["GroupData"] = DB::table("base_admin_group")->where("group_id", "=", $group_id)->get();
        $data['articleAdmin'] = DB::table("base_admin_group")
                ->leftJoin("base_admin", "admin_group", "=", "group_id")
                ->where("group_id", "=", $group_id)
                ->get();
       // dump($data);
        $data['checkAdmin'] = DB::table("base_admin")->get();
        $data['checkPower'] = DB::table("base_admin_power")->get();
        $AdminPowerGroup= DB::table("base_admin_re_power")
                ->leftJoin("base_admin_power", "power_id", "=", "relation_power_id")
                ->where("relation_group_id", "=", $group_id)

                ->get();
        $power_ids=array();
        foreach ($AdminPowerGroup as $value)
        {
            $power_ids[]=$value->power_id;
        }
        $data['power_ids']=$power_ids;
        $data['AdminPowerGroup']=$AdminPowerGroup;


        return view("Admin.Power.moreAdminPowerGroup", $data);
    }

    public function addPowerToAdminPowerGroup(BaseFunc $baseFunc) 
    {
        $postData = Request::only("group_id", "power_id_array");
        if($postData['power_id_array'] == "")
        {
          $baseFunc->setRedirectMessage(false, "没有选择权限！", NULL, NULL);
          return redirect()->back();
        }
        foreach ($postData["power_id_array"] as $data) 
        {
          DB::table("base_admin_re_power")->insert(["relation_power_id" => $data, "relation_group_id" => $postData["group_id"]]);
        }
        $baseFunc->setRedirectMessage(true, "添加权限成功！", NULL, NULL);
        return redirect()->back();
    }

    public function addAdminToAdminPowerGroup(BaseFunc $baseFunc) 
    {
        $groupId = Request::input('group_id');
        $admin_id_array = Request::input("admin_id_array");
        foreach ($admin_id_array as $data) 
        {
            DB::table("base_admin")->where("admin_id", "=", $data)->update(["admin_group" => $groupId]);
        }
        $baseFunc->setRedirectMessage(true, "添加管理员成功！", NULL, NULL);
        return redirect()->back();
    }

    public function removePowerToAdminPowerGroup(BaseFunc $baseFunc, $relation_power_id)
    {
        DB::table("base_admin_re_power")
                ->leftJoin("base_admin_power", "power_id", "=", "relation_power_id")
                ->where("relation_power_id", "=", $relation_power_id)
                ->delete();
        $baseFunc->setRedirectMessage(true, "删除权限成功！", NULL, NULL);
        return redirect()->back();
    }

    public function removeAdminToAdminPowerGroup(BaseFunc $baseFunc)
    {
        DB::table("base_admin")
                ->where("admin_id", "=", Request::input("admin_id"))
                ->update(["admin_group" => NULL]);
        $baseFunc->setRedirectMessage(true, "移除管理员成功！", NULL, NULL);
        return redirect()->back();
    }

}
