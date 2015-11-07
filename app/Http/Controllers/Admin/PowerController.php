<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\LogFunc;
use GirdPlugins\Base\AdminPowerFunc;
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

    public function _aAdmin(AdminPowerFunc $adminPowerFunc,BaseFunc $baseFunc,LogFunc $logFunc) 
    {
        $powerId=5;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
        $input = Request::only('admin_username', 'admin_nickname', 'admin_password','admin_group');
        $input["admin_password"] = md5('admin_password');
        DB::beginTransaction();
        DB::table("base_admin")->insert($input);
        $log_array['log_level']=0;
        $log_array['log_title']="添加操作";
        $log_array['log_detail']=  date("Y-m-d H:i:s").session('admin_nickname')."添加了一个管理员用户";
        $log_array['log_data']="添加";
        $log_array['log_admin']=session('admin_nickname');
        $logFunc->addLog($log_array);
        DB::commit();
        $baseFunc->setRedirectMessage(true, "添加管理员用户成功！", NULL, "/admin_sAdmin");
    }

    /*public function moreAdmin($admin_id)
    {
        $data["AdminData"] = DB::table("base_admin")->where("admin_id", "=", $admin_id)->get();
        $data["GroupData"] = DB::table("base_admin_group")->get();
        $data["GroupPowerData"] = DB::table("base_admin_re_power")->get();
        return view("Admin.Power.moreAdmin", $data);
    }*/

    public function uAdmin(AdminPowerFunc $adminPowerFunc,BaseFunc $baseFunc,LogFunc $logFunc)
    {
        $powerId=5;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
        $adminId = Request::input('admin_id');
        $adminUserName = Request::input("admin_username");
        $adminNickName = Request::input("admin_nickname");
        $adminGroup = Request::input("admin_group");
        DB::beginTransaction();
        DB::table("base_admin")->where("admin_id", "=", $adminId)->update([
            "admin_username" => $adminUserName,
            "admin_nickname" => $adminNickName,
            "admin_group" => $adminGroup
        ]);
        $log_array['log_level']=0;
        $log_array['log_title']="更新操作";
        $log_array['log_detail']=  date("Y-m-d H:i:s").session('admin_nickname')."更新了一个管理员用户";
        $log_array['log_data']="更新";
        $log_array['log_admin']=session('admin_nickname');
        $logFunc->addLog($log_array);
        DB::commit();
        $baseFunc->setRedirectMessage(true, "修改管理员用户信息成功！", NULL, "/admin_sAdmin");
    }

    public function dAdmin(AdminPowerFunc $adminPowerFunc,BaseFunc $baseFunc, $admin_id,LogFunc $logFunc)
    {
        $powerId=5;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
        DB::beginTransarticle();
        DB::table("base_admin")->where("admin_id", "=", $admin_id)->delete();
        $log_array['log_level']=0;
        $log_array['log_title']="删除操作";
        $log_array['log_detail']=  date("Y-m-d H:i:s").session('admin_nickname')."删除了一个管理员用户";
        $log_array['log_data']="删除";
        $log_array['log_admin']=session('admin_nickname');
        $logFunc->addLog($log_array);
        DB::commit();
        $baseFunc->setRedirectMessage(true, "删除管理员用户成功！", NULL, "/admin_sAdmin");
    }

    public function sAdminPowerGroup()
    {

        session(["now_address" => "/admin_sAdminPowerGroup"]);

        $data["GroupData"] = DB::table("base_admin_group")->paginate(5);
        return view("Admin.Power.sAdminPowerGroup", $data);
    }

    /*public function aAdminPowerGroup() 
    {
        return view("Admin.Power.aAdminPowerGroup");
    }*/

    public function _aAdminPowerGroup(AdminPowerFunc $adminPowerFunc,BaseFunc $baseFunc,LogFunc $logFunc )
    {
        $powerId=5;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
        $input = Request::only('group_name');
        DB::beginTransaction();
        DB::table("base_admin_group")->insert($input);
        $log_array['log_level']=0;
        $log_array['log_title']="添加操作";
        $log_array['log_detail']=  date("Y-m-d H:i:s").session('admin_nickname')."添加了一个权限组";
        $log_array['log_data']="添加";
        $log_array['log_admin']=session('admin_nickname');
        $logFunc->addLog($log_array);
        DB::commit();
        $baseFunc->setRedirectMessage(true, "添加权限组成功！", NULL, "/admin_sAdminPowerGroup");
    }

    public function uAdminPowerGroup(AdminPowerFunc $adminPowerFunc,BaseFunc $baseFunc,LogFunc $logFunc)
    {
        $powerId=5;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
        $groupId = Request::input('group_id');
        $groupName = Request::input("group_name");
        DB::beginTransaction();
        DB::table("base_admin_group")->where("group_id", "=", $groupId)->update(["group_name" => $groupName]);
        $log_array['log_level']=0;
        $log_array['log_title']="更新操作";
        $log_array['log_detail']=  date("Y-m-d H:i:s").session('admin_nickname')."更新了一个权限组";
        $log_array['log_data']="更新";
        $log_array['log_admin']=session('admin_nickname');
        $logFunc->addLog($log_array);
        DB::commit();
        $baseFunc->setRedirectMessage(true, "修改权限组名称成功！", NULL, "/admin_sAdminPowerGroup");
    }

    public function dAdminPowerGroup(AdminPowerFunc $adminPowerFunc,BaseFunc $baseFunc, $group_id,LogFunc $logFunc)
    {
        $powerId=5;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
        DB::beginTransaction();
        DB::table("base_admin_group")->where("group_id", "=", $group_id)->delete();
        $log_array['log_level']=0;
        $log_array['log_title']="删除操作";
        $log_array['log_detail']=  date("Y-m-d H:i:s").session('admin_nickname')."删除了一个权限组";
        $log_array['log_data']="删除";
        $log_array['log_admin']=session('admin_nickname');
        $logFunc->addLog($log_array);
        DB::commit();
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

    public function addPowerToAdminPowerGroup(AdminPowerFunc $adminPowerFunc,BaseFunc $baseFunc, LogFunc $logFunc) 
    {
        $powerId=5;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
        $postData = Request::only("group_id", "power_id_array");
        if($postData['power_id_array'] == "")
        {
          $baseFunc->setRedirectMessage(false, "没有选择权限！", NULL, NULL);
          return redirect()->back();
        }
        DB::beginTransaction();
        foreach ($postData["power_id_array"] as $data) 
        {
          DB::table("base_admin_re_power")->insert(["relation_power_id" => $data, "relation_group_id" => $postData["group_id"]]);
        }
        $log_array['log_level']=0;
        $log_array['log_title']="添加操作";
        $log_array['log_detail']=  date("Y-m-d H:i:s").session('admin_nickname')."添加了权限";
        $log_array['log_data']="添加";
        $log_array['log_admin']=session('admin_nickname');
        $logFunc->addLog($log_array);
        DB::commit();
        $baseFunc->setRedirectMessage(true, "添加权限成功！", NULL, NULL);
        return redirect()->back();
    }

    public function addAdminToAdminPowerGroup(AdminPowerFunc $adminPowerFunc,BaseFunc $baseFunc, LogFunc $logFunc) 
    {
        $powerId=5;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
        $groupId = Request::input('group_id');
        $admin_id_array = Request::input("admin_id_array");
        DB::beginTransaction();
        foreach ($admin_id_array as $data) 
        {
            DB::table("base_admin")->where("admin_id", "=", $data)->update(["admin_group" => $groupId]);
        }
        $log_array['log_level']=0;
        $log_array['log_title']="添加操作";
        $log_array['log_detail']=  date("Y-m-d H:i:s").session('admin_nickname')."向权限组添加了一个管理员";
        $log_array['log_data']="添加";
        $log_array['log_admin']=session('admin_nickname');
        $logFunc->addLog($log_array);
        DB::commit();
        $baseFunc->setRedirectMessage(true, "添加管理员成功！", NULL, NULL);
        return redirect()->back();
    }

    public function removePowerToAdminPowerGroup(AdminPowerFunc $adminPowerFunc,BaseFunc $baseFunc, $relation_power_id,LogFunc $logFunc)
    {
        $powerId=5;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
        DB::beginTransaction();
        DB::table("base_admin_re_power")
                ->leftJoin("base_admin_power", "power_id", "=", "relation_power_id")
                ->where("relation_power_id", "=", $relation_power_id)
                ->delete();
        $log_array['log_level']=0;
        $log_array['log_title']="移除操作";
        $log_array['log_detail']=  date("Y-m-d H:i:s").session('admin_nickname')."从权限组移除了一个权限";
        $log_array['log_data']="移除";
        $log_array['log_admin']=session('admin_nickname');
        $logFunc->addLog($log_array);
        DB::commit();
        $baseFunc->setRedirectMessage(true, "移除权限成功！", NULL, NULL);
        return redirect()->back();
    }

    public function removeAdminToAdminPowerGroup(AdminPowerFunc $adminPowerFunc,BaseFunc $baseFunc,LogFunc $logFunc)
    {
        $powerId=5;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $baseFunc->setRedirectMessage(false, "您没有权限进行此操作，请联系超级管理员", NULL, "null");
            return redirect()->back();
        }
        DB::beginTransaction();
        DB::table("base_admin")
                ->where("admin_id", "=", Request::input("admin_id"))
                ->update(["admin_group" => NULL]);
        $log_array['log_level']=0;
        $log_array['log_title']="移除操作";
        $log_array['log_detail']=  date("Y-m-d H:i:s").session('admin_nickname')."从权限组移除了一个管理员用户";
        $log_array['log_data']="移除";
        $log_array['log_admin']=session('admin_nickname');
        $logFunc->addLog($log_array);
        DB::commit();
        $baseFunc->setRedirectMessage(true, "移除管理员成功！", NULL, NULL);
        return redirect()->back();
    }

}
