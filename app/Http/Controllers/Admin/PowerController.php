<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use BaseClass\Base\AdminPowerGroup;
use BaseClass\Role\Admin;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\LogFunc;
use GirdPlugins\Base\AdminPowerFunc;

class PowerController extends Controller
{

    public function sAdmin()
    {
        session(["now_address" => "/admin_sAdmin"]);

        $paginate = true;  //要分页
        $data = Admin::getAdmin($paginate);

        if ($paginate) {
            $data["paginate"] = true;
        } else {
            $data["paginate"] = false;
        }

        return view("Admin.Power.sAdmin", $data);
    }

    public function _aAdmin(AdminPowerFunc $adminPowerFunc, BaseFunc $baseFunc, LogFunc $logFunc)
    {

        if (!AdminPowerGroup::checkAdminPower(5)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }


        $input = Request::only('admin_username', 'admin_nickname', 'admin_password', 'admin_group');
        $input["admin_password"] = md5('admin_password');
        $data["admin_username"] = DB::table('base_admin')->where("admin_username", "=", $input['admin_username'])->get();
        if ($data['admin_username'] != NULL) {
            $baseFunc->setRedirectMessage(false, "添加管理员用户失败！", "已经有此管理员用户", NULL);
            return redirect()->back();
        } else {
            Admin::addAdmin($input);
            $baseFunc->setRedirectMessage(true, "添加管理员用户成功！", NULL, "/admin_sAdmin");
        }

    }


    public function uAdmin(AdminPowerFunc $adminPowerFunc, BaseFunc $baseFunc, LogFunc $logFunc)
    {

        if (!AdminPowerGroup::checkAdminPower(5)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }


        $data["adminId"] = Request::input('admin_id');
        $data["adminUserName"] = Request::input('admin_username');
        $data["adminNickName"] = Request::input('admin_nickname');
        $data["adminGroup"] = Request::input('admin_group');

        $admin = new Admin($data["adminId"]);
        $admin->updateAdmin($data);

        $baseFunc->setRedirectMessage(true, "修改管理员用户信息成功！", NULL, "/admin_sAdmin");
    }

    public function dAdmin(BaseFunc $baseFunc, $admin_id)
    {

        if (!AdminPowerGroup::checkAdminPower(5)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }

        $admin = new Admin($admin_id);
        $admin->delete();
        $baseFunc->setRedirectMessage(true, "删除管理员用户成功！", NULL, "/admin_sAdmin");
    }

    public function sAdminPowerGroup(BaseFunc $baseFunc)
    {
        session(["now_address" => "/admin_sAdminPowerGroup"]);

        $data['readPower'] = DB::table("base_admin_re_power")->where("relation_power_id", "=", 4)->get();

        $paginate = true;  //是否分页，true为分页，false为不分页
        $data["GroupData"] = AdminPowerGroup::getAdminPowerGroup($paginate);
        if ($paginate) {
            $data["paginate"] = true;
        } else {
            $data["paginate"] = false;
        }


        return view("Admin.Power.sAdminPowerGroup", $data);


    }

    /*public function aAdminPowerGroup() 
    {
        return view("Admin.Power.aAdminPowerGroup");
    }*/

    public function _aAdminPowerGroup(BaseFunc $baseFunc)
    {

        if (AdminPowerGroup::checkAdminPower(5))//$adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }

        $input = Request::only('group_name');
        AdminPowerGroup::add($input["group_name"]);

        $baseFunc->setRedirectMessage(true, "添加权限组成功！", NULL, "/admin_sAdminPowerGroup");
    }

    public function uAdminPowerGroup(BaseFunc $baseFunc)
    {

        if (AdminPowerGroup::checkAdminPower(5)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }

        $groupId = Request::input('group_id');
        $groupName = Request::input("group_name");
        AdminPowerGroup::update($groupName, $groupId);

        $baseFunc->setRedirectMessage(true, "修改权限组名称成功！", NULL, "/admin_sAdminPowerGroup");
    }

    public function dAdminPowerGroup(BaseFunc $baseFunc, $group_id, LogFunc $logFunc)
    {

        if (AdminPowerGroup::checkAdminPower(5)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
        AdminPowerGroup::delete($group_id);

        $baseFunc->setRedirectMessage(true, "删除权限组成功！", NULL, "/admin_sAdminPowerGroup");
    }

    public function moreAdminPowerGroup(BaseFunc $baseFunc)
    {
        $group_id = Request::get("group_id");
        if (!AdminPowerGroup::checkAdminPower(4)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }

        $admin = new AdminPowerGroup($group_id);

        $data = $admin->moreAdminPowerGroup();

        return view("Admin.Power.moreAdminPowerGroup", $data);
    }

    public function addPowerToAdminPowerGroup(BaseFunc $baseFunc)
    {

        if (AdminPowerGroup::checkAdminPower(5)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }

        $postData = Request::only("group_id", "power_id_array");
        if ($postData['power_id_array'] == "") {
            $baseFunc->setRedirectMessage(false, "没有选择权限！", NULL, NULL);
            return redirect()->back();
        }
        $admin = new AdminPowerGroup($postData["group_id"]);
        foreach ($postData["power_id_array"] as $data) {
            $admin->addPower($data);
        }

        $baseFunc->setRedirectMessage(true, "添加权限成功！", NULL, NULL);
        return redirect()->back();
    }

    public function addAdminToAdminPowerGroup(AdminPowerFunc $adminPowerFunc, BaseFunc $baseFunc, LogFunc $logFunc)
    {

        if (AdminPowerGroup::checkAdminPower(5)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }

        $groupId = Request::input('group_id');
        $admin_id_array = Request::input("admin_id_array");
        $admin = new AdminPowerGroup($groupId);
        $admin->addAdmin($admin_id_array);
        $baseFunc->setRedirectMessage(true, "添加管理员成功！", NULL, NULL);
        foreach ($admin_id_array as $data) {

            $admin->addAdmin($data);

        }
        return redirect()->back();
    }

    public function removePowerToAdminPowerGroup(BaseFunc $baseFunc)
    {

        if (AdminPowerGroup::checkAdminPower(5)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }

        $powerId = $_POST["relation_power_id"];
        $groupId = $_POST["relation_group_id"];

        $admin = new AdminPowerGroup($groupId);
        $admin->removePower($powerId);

        $baseFunc->setRedirectMessage(true, "移除权限成功！", NULL, NULL);
        return redirect()->back();
    }

    public function removeAdminToAdminPowerGroup(BaseFunc $baseFunc)
    {

        if (AdminPowerGroup::checkAdminPower(5)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
        AdminPowerGroup::removeAdmin(Request::input("admin_id"));
        $baseFunc->setRedirectMessage(true, "移除管理员成功！", NULL, NULL);
        return redirect()->back();
    }

}
