<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PowerController extends Controller {

    public function sAdmin() {
        $data["AdminData"] = DB::table("base_admin")->get();
        return view("Admin.Power.sAdmin", $data);
    }

    public function aAdmin() {
        return view("Admin.Power.aAdmin");
    }

    public function _aAdmin(BaseFunc $baseFunc) {
        $input = Request::only('admin_username', 'admin_nickname', 'admin_password');
        $input["admin_password"] = md5('admin_password');
        $data = DB::table("base_admin")->insert($input);
        $baseFunc->setRedirectMessage(true, "添加管理员用户成功！", NULL, "/admin_sAdmin");
    }

    public function moreAdmin($admin_id) {
        $data["AdminData"] = DB::table("base_admin")->where("admin_id", "=", $admin_id)->get();
        $data["GroupData"] = DB::table("base_admin_group")->get();
        $data["GroupPowerData"] = DB::table("base_admin_re_power")->get();
        return view("Admin.Power.moreAdmin", $data);
    }

    public function uAdmin(BaseFunc $baseFunc) {
        $adminId = Request::input('admin_id');
        $adminUserName = Request::input("admin_username");
        $adminNickName = Request::input("admin_nickname");
        $adminGroup = Request::input("admin_group");
        $data = DB::table("base_admin")->where("admin_id", "=", $adminId)->update([
            "admin_username" => $adminUserName,
            "admin_nickName" => $adminNickName,
            "admin_group" => $adminGroup
        ]);
        $baseFunc->setRedirectMessage(true, "修改管理员用户信息成功！", NULL, "/admin_sAdmin");
    }

    public function dAdmin(BaseFunc $baseFunc, $admin_id) {
        DB::table("base_admin")->where("admin_id", "=", $admin_id)->delete();
        $baseFunc->setRedirectMessage(true, "删除管理员用户成功！", NULL, "/admin_sAdmin");
    }

    public function sAdminPowerGroup() {
        $data["GroupData"] = DB::table("base_admin_group")->get();
        return view("Admin.Power.sAdminPowerGroup", $data);
    }

    public function aAdminPowerGroup() {
        return view("Admin.Power.aAdminPowerGroup");
    }

    public function _aAdminPowerGroup(BaseFunc $baseFunc) {
        $input = Request::only('group_name');
        DB::table("base_admin_group")->insert($input);
        $baseFunc->setRedirectMessage(true, "添加权限组成功！", NULL, "/admin_sAdminPowerGroup");
    }

    public function uAdminPowerGroup(BaseFunc $baseFunc) {
        $groupId = Request::input('group_id');
        $groupName = Request::input("group_name");
        $data = DB::table("base_admin_group")->where("group_id", "=", $groupId)->update(["group_name" => $groupName]);
        $baseFunc->setRedirectMessage(true, "修改权限组名称成功！", NULL, "/admin_sAdminPowerGroup");
    }

    public function dAdminPowerGroup(BaseFunc $baseFunc, $group_id) {
        DB::table("base_admin_group")->where("group_id", "=", $group_id)->delete();
        $baseFunc->setRedirectMessage(true, "删除权限组成功！", NULL, "/admin_sAdminPowerGroup");
    }

    public function moreAdminPowerGroup($group_id) {
        $data["GroupData"] = DB::table("base_admin_group")->where("group_id", "=", $group_id)->get();
        $data["PowerData"] = DB::table("base_admin_power")->get();
        $data["GroupPowerData"] = DB::table("base_admin_re_power")->get();
        return view("Admin.Power.moreAdminPowerGroup", $data);
    }

    public function addPowerToAdminPowerGroup()
    {
        $data["PowerData"] = DB::table("base_admin_power")->get();
        $data["GroupPowerData"] = DB::table("base_admin_re_power")->get();
        return view("Admin.Power.moreAdminPowerGroup", $data);
    }
}
