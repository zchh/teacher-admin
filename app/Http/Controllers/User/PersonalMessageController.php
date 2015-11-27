<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\ArticleFunc;
use GirdPlugins\Base\LogFunc;      //zc
use GirdPlugins\Base\UserPowerFunc;      //zc

class PersonalMessageController extends Controller {

    public function uPersonalMessage() {
        session(["nowPage"=>"/user_sPersonalMessage"]);
        $userId = session("user.user_id");
        $inputData["personalMessage"] = DB::table('base_user')->where('user_id', '=', $userId)->first();
        return view("User.PersonalMessage.uPersonalMessage", $inputData);
    }

    public function _uPersonalMessage(BaseFunc $baseFunc, LogFunc $logFunc, UserPowerFunc $UserPowerFunc) {

        //操作记录
        $log_array["log_level"] = 0;
        $log_array["log_title"] = "修改base_user表中的一条记录";
        $log_array["log_detail"] = "修改base_user表中的一条记录,只改变其中的user_nickname,user_password,user_age,user_intro,user_sex,user_update_date";
        $log_array["log_date"] = date('Y-m-d H:i:s');
        $log_array["log_user"] = session("user.user_id");

        //获取表单信息
        $personalMessageData = Request::only("user_nickname", "user_age", "user_intro", "user_sex");
        $personalMessageData["user_update_date"] = date('Y-m-d H:i:s');
        $userId = session("user.user_id");

        //传递文章封面ID
        if (session("image.image_id") != null) {  //zc
            $personalMessageData["user_image"] = session("image.image_id");
        }

        //判断是否存在此用户
        $i = 0;
        $data = DB::table('base_user')->get();
        foreach ($data as $single) {
            if ($single->user_id == $userId) {
                break;
            } else {
                $i ++;
            }
        }
        if ($i >= count($data)) {
            $baseFunc->setRedirectMessage(true, "修改失败，该用户已不存在", NULL, "/user_uPersonalMessage");
        }
        
        /*
          if (!$UserPowerFunc->checkUserPower(10)) {                    //权限验证
          return redirect()->back();  //跳回上一页
          }
         * *
         */

        $count1 = DB::table('base_user')->where('user_id', '=', $userId)->update($personalMessageData);
        Session::put("image.image_id", null); //zc
        $logFunc->insertLog($log_array);    //插入操作记录
        $baseFunc->setRedirectMessage(true, "修改成功", NULL, "/user_uPersonalMessage");
    }

}
