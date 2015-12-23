<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use BaseClass\Base\AdminPowerGroup;
use BaseClass\Role\Admin;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;

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

    public function _aAdmin(BaseFunc $baseFunc)
    {

        if (!AdminPowerGroup::checkAdminPower(5)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }


        $input = Request::only('admin_username', 'admin_nickname', 'admin_password', 'admin_group');
        $input["admin_password"] = md5('admin_password');

        if( Admin::addAdmin($input))
        {
            $baseFunc->setRedirectMessage(true, "添加管理员用户成功！", NULL, "/admin_sAdmin");
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "添加管理员用户失败！", "已经有此管理员用户或数据插入失败", NULL);
            return redirect()->back();
        }

    }


    public function uAdmin( BaseFunc $baseFunc)
    {
        /*

        if (!AdminPowerGroup::checkAdminPower(5)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
        */


        $data["adminId"] = Request::input('admin_id');
        $data["adminUserName"] = Request::input('admin_username');
        $data["adminNickName"] = Request::input('admin_nickname');
        $data["adminGroup"] = Request::input('admin_group');

        $admin = new Admin($data["adminId"]);
       $return =  $admin->updateAdmin($data);
        if($return == true)
        {
            $baseFunc->setRedirectMessage(true, "修改管理员用户信息成功！", NULL, "/admin_sAdmin");
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "修改管理员用户信息失败！", NULL, "/admin_sAdmin");
        }

    }

    public function dAdmin(BaseFunc $baseFunc, $admin_id)
    {
        /*
        if (!AdminPowerGroup::checkAdminPower(5)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
        */


        $admin = new Admin($admin_id);
       $return = $admin->delete();
        if($return == true)
        {
            $baseFunc->setRedirectMessage(true, "删除管理员用户成功！", NULL, "/admin_sAdmin");
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "删除管理员用户失败！", NULL, "/admin_sAdmin");
        }

    }

    public function sAdminPowerGroup()
    {
        session(["now_address" => "/admin_sAdminPowerGroup"]);

        $paginate = true;  //是否分页，true为分页，false为不分页

        $data = AdminPowerGroup::getAdminPowerGroup($paginate);
        if ($paginate) {
            $data["paginate"] = true;
        } else {
            $data["paginate"] = false;
        }


        return view("Admin.Power.sAdminPowerGroup", $data);


    }

    public function _aAdminPowerGroup(BaseFunc $baseFunc)
    {
         /*
        if (!AdminPowerGroup::checkAdminPower(5))//$adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
         */

        $input = Request::only('group_name');
        $return = AdminPowerGroup::add($input["group_name"]);
        if($return != false)
        {
            $baseFunc->setRedirectMessage(true, "添加权限组成功！", NULL, "/admin_sAdminPowerGroup");
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "添加权限组失败！", NULL, "/admin_sAdminPowerGroup");
        }

    }

    public function uAdminPowerGroup(BaseFunc $baseFunc)
    {

        /*
        if (!AdminPowerGroup::checkAdminPower(5)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
        */

        $groupId = Request::input('group_id');
        $groupName = Request::input("group_name");
       $count = AdminPowerGroup::update($groupName, $groupId);
        if($count >= 0)
        {
            $baseFunc->setRedirectMessage(true, "修改权限组名称成功！", NULL, "/admin_sAdminPowerGroup");
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "修改权限组名称失败！", NULL, "/admin_sAdminPowerGroup");
        }

    }

    public function dAdminPowerGroup(BaseFunc $baseFunc, $group_id)
    {
         /*
        if (!AdminPowerGroup::checkAdminPower(5)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
         */
       $return = AdminPowerGroup::delete($group_id);
        if($return == true)
        {
            $baseFunc->setRedirectMessage(true, "删除权限组成功！", NULL, "/admin_sAdminPowerGroup");
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "删除权限组失败！", NULL, "/admin_sAdminPowerGroup");
        }

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
       /*
        if (!AdminPowerGroup::checkAdminPower(5)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
       */



        $postData = Request::only("group_id", "power_id_array");

        $admin = new AdminPowerGroup($postData["group_id"]);
        $return =  $admin->addPower($postData["power_id_array"]);
        if($return != false)
        {
            $baseFunc->setRedirectMessage(true, "添加权限成功", NULL, "null");
            return redirect()->back();
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "添加权限失败", NULL, "null");
            return redirect()->back();
        }

    }

    public function addAdminToAdminPowerGroup(BaseFunc $baseFunc)
    {

        /*
        if (!AdminPowerGroup::checkAdminPower(5)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
        */

        $groupId = Request::input('group_id');
        $admin_id_array = Request::input("admin_id_array");
        $admin = new AdminPowerGroup($groupId);
       $return =  $admin->addAdmin( $admin_id_array);
        if($return != false)
        {
            $baseFunc->setRedirectMessage(true, "添加管理员成功", NULL, "null");
            return redirect()->back();
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "添加管理员失败", NULL, "null");
            return redirect()->back();
        }

    }

    public function removePowerToAdminPowerGroup(BaseFunc $baseFunc)
    {

        /*
        if (!AdminPowerGroup::checkAdminPower(5)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
        */

        $powerId = $_POST["relation_power_id"];
        $groupId = $_POST["relation_group_id"];

        $admin = new AdminPowerGroup($groupId);
       $return =  $admin->removePower($powerId);
        if($return == true)
        {
            $baseFunc->setRedirectMessage(true, "移除权限成功！", NULL, NULL);
            return redirect()->back();
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "移除权限失败！", NULL, NULL);
            return redirect()->back();
        }



    }

    public function removeAdminToAdminPowerGroup(BaseFunc $baseFunc)
    {
       /*
        if (!AdminPowerGroup::checkAdminPower(5)) {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
       */
       $return =  AdminPowerGroup::removeAdmin(Request::input("admin_id"));
        if($return == true)
        {
            $baseFunc->setRedirectMessage(true, "移除管理员成功！", NULL, NULL);
            return redirect()->back();
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "移除管理员失败！", NULL, NULL);
            return redirect()->back();
        }
    }

}
