<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\LogFunc;
use GirdPlugins\Base\AdminPowerFunc;
class UserPowerController extends Controller {
    //查看所有的用户
    public function sUser()
    {
        session(["now_address" => "/admin_sUser"]);
        $input_data['user_data'] = DB::table("base_user")->orderBy("user_id","desc")
                ->leftJoin("base_user_group","user_group","=","group_id")
                ->get();
        //查找所有的权限组显示出来选择用于更改当前用户的权限组
        $input_data['group_data'] = DB::table("base_user_group")->get();
        //dump($input_data);
        return view("Admin.UserPower.sUser",$input_data);
    }
    //修改用户权限（重新为用户分配一个权限组）
    public function uUser(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base)
    {
        $powerId=3;
        if($adminPowerFunc->checkAdminPower($powerId) == flase)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        $input_data  = Request::only("user_id","user_username","user_nickname","user_group");
        //判断有没有选择权限组信息
        if($input_data['user_group'] == "")
        {
            $base->setRedirectMessage(false, "添加失败，您还没有选择权限组信息", null, null);
            return redirect()->back();
        }
        if(DB::table("base_user")->where("user_id","=",$input_data['user_id'])->where("user_group","=",$input_data['user_group'])->get())
        {
            $base->setRedirectMessage(false, "添加失败，您目前已经属于此权限组,请重新选择", null, null);
            return redirect()->back();
        }
        $input_data['user_update_date']=date("Y-m-d H:i:s");
        DB::beginTransaction();
        if(DB::table("base_user")->where("user_id","=",$input_data['user_id'])->
                update(['user_group'=>$input_data['user_group']])
                )
        {
            $base->setRedirectMessage(true, "修改成功", null, null);
            //在修改用户权限之后添加此记录
            $log_array["log_level"]=0;
            $log_array["log_title"]="修改操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."修改用户权限（重新为用户分配一个权限组）";
            $log_array["log_data"]="修改";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            return redirect()->back();
        }
        else
        {
            $base->setRedirectMessage(false, "修改失败", null, null);
            return redirect()->back();
        }
        
        //dump($input_data);
    }
    //删除用户
    public function dUser(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base,$user_id)
    {
        $powerId=3;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        DB::beginTransaction();
        if(DB::table("base_user")->where("user_id","=",$user_id)->delete())
        {
            $base->setRedirectMessage(true, "删除成功", null, null);
             //在删除用户之后添加此记录
            $log_array["log_level"]=0;
            $log_array["log_title"]="删除操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."修改了一个用户";
            $log_array["log_data"]="删除";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            return redirect()->back();
        }
        else
        {
            $base->setRedirectMessage(false, "删除失败", null, null);
            return redirect()->back();
        }
       
    }
    //添加用户
    public function aUser(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base)
    {
        $powerId=3;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        $input_data = Request::only("user_username","user_nickname","user_password","user_group");
        DB::beginTransaction();
        if(DB::table("base_user")->insert($input_data))
        {
            $base->setRedirectMessage(true, "添加成功", null, null);
            //在删除用户权限之后添加此记录
            $log_array["log_level"]=0;
            $log_array["log_title"]="添加操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."添加了一个用户";
            $log_array["log_data"]="添加";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            return redirect()->back();
        }
        else
        {
            $base->setRedirectMessage(false, "删除失败", null, null);
            return redirect()->back();
        }
        
        //dump($input_data);
    }
    /*
     * 
     * //权限部分
     * 
     */
    //查看所有权限组
    public function sUserPowerGroup()
    {
        session(["now_address" => "/admin_sUserPowerGroup"]);
        $input_data['group_data'] = DB::table("base_user_group")->get();
        return view("Admin.UserPower.sUserPowerGroup",$input_data);
    }
    //添加权限组
    public function aUserPowerGroup(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base)
    {
        $powerId=3;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        $input_data = Request::only("group_name");
        DB::beginTransaction();
        if(DB::table("base_user_group")->insert($input_data))
        {
            $base->setRedirectMessage(true, "添加权限组成功", null, null);
            //在添加一个权限组之后添加此记录
            $log_array["log_level"]=0;
            $log_array["log_title"]="添加操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."添加了一个权限组";
            $log_array["log_data"]="添加";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            return redirect()->back();
        }
        else
        {
            $base->setRedirectMessage(false, "添加权限组失败", null, null);
            return redirect()->back();
        }
        
        //dump($input_data);
    }
    //修改权限组
    public function uUserPowerGroup(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base)
    {
        $powerId=3;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        $input_data = Request::only("group_id","group_name");
        DB::beginTransaction();
        if(DB::table("base_user_group")->where("group_id","=",$input_data['group_id'])
                ->update(["group_name"=>$input_data['group_name']]))
        {
            $base->setRedirectMessage(true, "修改权限组成功", null, null);
             //在修改了一个权限组之后添加此记录
            $log_array["log_level"]=0;
            $log_array["log_title"]="修改操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."修改了一个权限组";
            $log_array["log_data"]="修改";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB:;commit();
            return redirect()->back();
        }
        else
        {
            $base->setRedirectMessage(false, "修改权限组失败", null, null);
            return redirect()->back();
        }
       
        //dump($input_data);
    }
    //删除权限组
    public function dUserPowerGroup(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base,$group_id)
    {
        $powerId=3;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        DB::beginTransaction();
        if(DB::table("base_user_group")->where("group_id","=",$group_id)->delete())
        {
            $base->setRedirectMessage(true, "删除权限组成功", null, null);
            //在删除了一个权限组之后添加此记录
            $log_array["log_level"]=0;
            $log_array["log_title"]="删除操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."删除了一个权限组";
            $log_array["log_data"]="删除";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            return redirect()->back();
        }
        else
        {
            $base->setRedirectMessage(false, "删除权限组失败", null, null);
            return redirect()->back();
        }
        
    }
    //权限组详情页
    public function moreUserPowerGroup($group_id)
    {
        //根据id获取当前权限组信息（返回一条记录）
        $input_data['group_data_by_id'] = DB::table("base_user_group")->where("group_id","=",$group_id)->get();
        //获取当前权限组的所有权限信息
        $power_data_by_groupid = DB::table("base_user_group")->leftJoin("base_user_re_power","group_id","=","relation_group")
                ->leftJoin("base_user_power","relation_power","=","power_id")
                ->where("group_id","=",$group_id)->get();
        $input_data['power_data_by_groupid']=$power_data_by_groupid;
        //获取当前权限组的用户信息
        $input_data['user_data_by_groupid'] = DB::table("base_user_group")->leftJoin("base_user","group_id","=","user_group")
                ->where("group_id","=",$group_id)->get();
        //dump($input_data);
        //获取所有的权限信息供添加权限到指定权限组的时候用
        $input_data['all_power_data'] = DB::table("base_user_power")->get();
        //获取所有的用户供添加用户到指定权限组的时候用
        $input_data['all_user_data'] = DB::table("base_user")->get();
        //获取当前权限组的所有权限并把所有的权限id获取到存入一个数组
        $arr=array();
        foreach ($power_data_by_groupid as $value) 
        {
            $arr[]=$value->power_id;
        }
        $input_data['power_ids']=$arr;
        //dump($input_data);
        return view("Admin.UserPower.moreUserPowerGroup",$input_data);
    }
    //从一个权限组移出权限
    public function removePowerToUserPowerGroup(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base,$group_id,$power_id)
    {
        $powerId=3;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        DB::beginTransaction();
        if(DB::table("base_user_re_power")->where("relation_group","=",$group_id)
                ->where("relation_power","=",$power_id)
                ->delete())
        {
            $base->setRedirectMessage(true, "从该权限组移除权限成功", null, null);
            //在移除了一个权限组之后添加此记录
            $log_array["log_level"]=0;
            $log_array["log_title"]="移除操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."移除了一个权限组(从一个权限组移出权限)";
            $log_array["log_data"]="移除";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            return redirect()->back();
        }
        else
        {
            $base->setRedirectMessage(false, "从该权限组移除权限失败", null, null);
            return redirect()->back();
        }
        
        //dump($group_id);
    }
    //从一个权限组移出用户
    public function removeUserToUserPowerGroup(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base)
    {
        $powerId=3;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        $input_data = Request::only("user_id");
        DB::beginTransaction();
        if(DB::table("base_user")->where("user_id","=",$input_data['user_id'])->update(["user_group"=>null]))
        {
            $base->setRedirectMessage(true, "从该权限组移除用户成功", null, null);
            //在移除了一个权限组之后添加此记录
            $log_array["log_level"]=0;
            $log_array["log_title"]="移除操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."移除了一个用户(从一个权限组移出用户)";
            $log_array["log_data"]="移除";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            return redirect()->back();
        }
        else
        {
            $base->setRedirectMessage(true, "从该权限组移除用户成功", null, null);
            return redirect()->back();
        }
        
        //dump($input_data);
    }
    //添加用户到一个权限组
    public function addUserToUserPowerGroup(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base)
    {
        $powerId=3;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        $input_data = Request::only("group_id","user_id_array");
        DB::beginTransaction();
        foreach ($input_data['user_id_array'] as $user_id) 
        {
            DB::table("base_user")->where("user_id","=",$user_id)->update(["user_group" => $input_data['group_id']]);
        }
        $base->setRedirectMessage(true, "添加用户到该权限组成功", null, null);
        //在添加用户到一个权限组之后添加此记录
        $log_array["log_level"]=0;
        $log_array["log_title"]="添加操作";
        $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."添加了一个用户(添加用户到一个权限组)";
        $log_array["log_data"]="添加";
        $log_array["log_admin"]=session("admin.admin_id");
        $logFunc->addLog($log_array);
        DB::commit();
        return redirect()->back();
    }
    //添加权限到一个权限组
    public function addPowerToUserPowerGroup(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base)
    {
        $powerId=3;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        $input_data = Request::only("group_id","power_id_array");
        if($input_data['power_id_array'] == null)
        {
            $base->setRedirectMessage(false, "你没有选择任何权限！", null, null);
            return redirect()->back();
        }
        DB::beginTransaction();
        foreach ($input_data['power_id_array'] as $value) 
        {
            DB::table("base_user_re_power")->insert(["relation_power" => $value, "relation_group" => $input_data['group_id']]);
        }
        $base->setRedirectMessage(true, "添加权限到该权限组成功", null, null);
         //在添加权限到一个权限组之后添加此记录
        $log_array["log_level"]=0;
        $log_array["log_title"]="添加操作";
        $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."添加了权限(添加权限到一个权限组)";
        $log_array["log_data"]="添加";
        $log_array["log_admin"]=session("admin.admin_id");
        $logFunc->addLog($log_array);
        DB::commit();
        return redirect()->back();
    }
}
