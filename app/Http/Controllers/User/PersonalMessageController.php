<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use BaseClass\Role\User;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\LogFunc;      //zc
use GirdPlugins\Base\UserPowerFunc;      //zc


class PersonalMessageController extends Controller {

    public function uPersonalMessage() {
        session(["nowPage"=>"/user_sPersonalMessage"]);
        $userId = session("user.user_id");
        $userObj=new User($userId);
        $inputData["personalMessage"] = $userObj->info;
        return view("User.PersonalMessage.uPersonalMessage", $inputData);
    }

    public function _uPersonalMessage(BaseFunc $baseFunc, LogFunc $logFunc, UserPowerFunc $UserPowerFunc) {



        //获取表单信息
        $personalMessageData = Request::only("user_nickname", "user_age", "user_intro", "user_sex");
        $userId = session("user.user_id");

        //传递文章封面ID
        if (session("image.image_id") != null) {  //zc
            $personalMessageData["user_image"] = session("image.image_id");
        }

        //判断是否存在此用户
         $userobj=new User($userId);

        if ($userobj == false) {
            $baseFunc->setRedirectMessage(true, "修改失败，该用户已不存在", NULL, "/user_uPersonalMessage");
        }
        
        /*
          if (!$UserPowerFunc->checkUserPower(10)) {                    //权限验证
          return redirect()->back();  //跳回上一页
          }
         * *
         */

        $userobj->update($personalMessageData);
        Session::put("image.image_id", null); //zc
        $baseFunc->setRedirectMessage(true, "修改成功", NULL, "/user_uPersonalMessage");
    }

}
