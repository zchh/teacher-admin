<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use BaseClass\Base\UserPowerGroup;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use BaseClass\Component\Article\ArticleClass;

class ClassController extends Controller {

    public function sClass() {
        session(["nowPage" => "/user_sClass"]);

        $user_id = session("user.user_id"); //获取用户id
        $combine['userArticleClass'] = ArticleClass::getMoreByUser($user_id,true);
        $combine['userId'] = $user_id;   //传递当前用户id到界面
        return view("User.Article.sClass", $combine);
    }

    public function aClass(BaseFunc $baseFunc) {  //添加类型

        if (!UserPowerGroup::checkUserPower(5)) {                    //权限验证
            $baseFunc->setRedirectMessage(false, "你没有权限");
        }
        $insertData = Request::only("class_name");
        $insertData["class_user"] = session("user.user_id");
        if(false!==ArticleClass::add($insertData))
        {
            $baseFunc->setRedirectMessage(true, "已完成",null,null);
            return redirect()->back();

        }
        else
        {
            $baseFunc->setRedirectMessage(false, "无法插入数据库",null,null);
            return redirect()->back();
        }
    }

    public function dClass($class_id, BaseFunc $baseFunc) {

        if (!UserPowerGroup::checkUserPower(5)) {                    //权限验证
            $baseFunc->setRedirectMessage(false, "你没有权限");
        }
        $userObj =new ArticleClass($class_id);
        if ($userObj->delete(session("user.user_id"))) {
            $baseFunc->setRedirectMessage(true, "删除成功", NULL, "/user_sClass");

        } else {
            $baseFunc->setRedirectMessage(false, "删除失败", NULL, "/user_sClass");

        }
    }

    public function uClass(BaseFunc $baseFunc) {


        $userId = session("user.user_id");
        $inputData = Request::only("class_id", "class_name");

        $classObj = new ArticleClass($inputData["class_id"]);
        if(false!==$classObj->update(["class_name"=>$inputData["class_name"]],$userId))
        {
            $baseFunc->setRedirectMessage(true, "修改成功", NULL, "/user_sClass");
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "修改失败", NULL, "/user_sClass");
        }

    }

}
