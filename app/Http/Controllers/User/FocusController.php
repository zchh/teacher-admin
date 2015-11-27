<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\ArticleFunc;
use GirdPlugins\Base\LogFunc;
use GirdPlugins\Base\UserPowerFunc;

class FocusController extends Controller 
{
    public function sFocus()
    {
        session(["nowPage"=>"/user_sFocus"]);
        $data['focusData']=DB::table('base_user_relation')
                ->leftJoin("base_user","user_id","=","relation_focus")
                ->get();
        return view("User.Focus.sFocus",$data);
    }
    public function aFocus(UserPowerFunc $userPowerFunc,LogFunc $logFunc,BaseFunc $base)
    {
        //dump(session("user"));exit();
        $powerId=10;
        if(!$userPowerFunc->checkUserPower($powerId))
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作，请联系超级管理员", NULL, NULL);
            return redirect()->back();
        }
        $focusData=  Request::only("relation_remark","relation_focus");
        $focusData['relation_create_time']=date("Y-m-d H:i:s");
        $focusData['relation_update_time']=date("Y-m-d H:i:s");
        $focusData['relation_user']=session("user.user_id");
       
       
        if($focusData["relation_focus"]!=$focusData["relation_user"])
        {
            DB::beginTransaction();
            DB::table("base_user_relation")->insert($focusData);
            $log_array['log_level']=0;
            $log_array['log_title']="关注操作";
            $log_array['log_detail']=  date("Y-m-d H:i:s").session('admin_nickname')."关注了一个用户";
            $log_array['log_data']="关注";
            $log_array['log_admin']=session('admin_nickname');
            $logFunc->addLog($log_array);
            DB::commit();
            $base->setRedirectMessage(true, "关注成功！", null, null);
            return redirect()->back();
        }
        else
        {
            $base->setRedirectMessage(false, "关注失败！", "您不能关注自已呦~", null);
            return redirect()->back();
        }
    }
    public function uFocus(UserPowerFunc $userPowerFunc,LogFunc $logFunc,BaseFunc $base)
    {
        $powerId=10;
        if(!$userPowerFunc->checkUserPower($powerId))
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作，请联系超级管理员", NULL, NULL);
            return redirect()->back();
        }
        $focusData=  Request::only("relation_remark");
        $focusData['relation_update_time']=date("Y-m-d H:i:s");
        $relationId = Request::input("relation_id");
        DB::beginTransaction();
        DB::table("base_user_relation")
                ->where("relation_id","=",$relationId)
                ->update($focusData);
        $log_array['log_level']=0;
        $log_array['log_title']="修改操作";
        $log_array['log_detail']= date("Y-m-d H:i:s").session('admin_nickname')."修改了一个用户备注";
        $log_array['log_data']="修改";
        $log_array['log_admin']=session('admin_nickname');
        $logFunc->addLog($log_array);
        DB::commit();
        $base->setRedirectMessage(true, "修改备注成功！", null, null);
        return redirect()->back();
    }
    
    
    public function dFocus(UserPowerFunc $userPowerFunc,LogFunc $logFunc,BaseFunc $base,$relation_id)
    {
        $powerId=10;
        if(!$userPowerFunc->checkUserPower($powerId))
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作，请联系超级管理员", NULL, NULL);
            return redirect()->back();
        }
        DB::beginTransaction();
        DB::table("base_user_relation")
                ->where("relation_id","=","$relation_id")
                ->delete();
        $log_array['log_level']=0;
        $log_array['log_title']="取消关注操作";
        $log_array['log_detail']= date("Y-m-d H:i:s").session('admin_nickname')."取消关注了一个用户";
        $log_array['log_data']="取消关注";
        $log_array['log_admin']=session('admin_nickname');
        $logFunc->addLog($log_array);
        DB::commit();
        $base->setRedirectMessage(true, "取消关注成功！", null, null);
        return redirect()->back();
    }
}
