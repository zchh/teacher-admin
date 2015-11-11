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

class ClassController extends Controller {

    public function sClass() {
        session(["nowPage" => "/user_sClass"]);
        // dump(session("nowPage"));
        $user_id = session("user.user_id"); //获取用户id
        $combine['userArticleClass'] = DB::table('base_article_class')    //为了获得作者，要合并两张表
                        ->join('base_user', 'base_article_class.class_user', '=', 'base_user.user_id')->paginate(10);
        $combine['userId'] = $user_id;   //传递当前用户id到界面
        return view("User.Article.sClass", $combine);
    }

    public function aClass(BaseFunc $baseFunc, LogFunc $logFunc, UserPowerFunc $UserPowerFunc) {  //添加类型
        //操作记录
        $log_array["log_level"] = 0;
        $log_array["log_title"] = "向base_article_class表中插入一条记录";
        $log_array["log_detail"] = "向base_article_class表中插入一条记录";
        $log_array["log_date"] = date('Y-m-d H:i:s');
        $log_array["log_user"] = session("user.user_id");

        //获取前端数据并且添加到数据库
        $getData = DB::table('base_article_class')->get();
        $record = count($getData);
        $i = 0;
        foreach ($getData as $singleData) {
            if ($singleData->class_name == $_POST['class_name']) {   //判断数据库中是否已经存在要添加的类型
                $baseFunc->setRedirectMessage(false, "此类型已存在", NULL, "/user_sClass");
                //exit();
                break;
            } else {
                $i ++;
            }
        }

        if (!$UserPowerFunc->checkUserPower(5)) {                    //权限验证
            return redirect()->back();  //跳回上一页     
        }


        if ($i == $record) {
            $data["class_name"] = $_POST['class_name'];
            $data["class_user"] = session("user.user_id");
            $data["class_create_date"] = date('Y-m-d H:i:s');
            $data["class_update_date"] = date('Y-m-d H:i:s');
            if (DB::table("base_article_class")->insert($data)) {
                $logFunc->insertLog($log_array);    //插入操作记录
                $baseFunc->setRedirectMessage(true, "数据插入成功", NULL, "/user_sClass");
            } else {
                $baseFunc->setRedirectMessage(false, "数据库查找失败", NULL, "/user_sClass");
            }
        }
    }

    public function dClass($class_id, BaseFunc $baseFunc, LogFunc $logFunc, UserPowerFunc $UserPowerFunc) {

        //操作记录
        $log_array["log_level"] = 0;
        $log_array["log_title"] = "删除base_article_class表中的一条记录";
        $log_array["log_detail"] = "删除base_article_class表中的一条记录";
        $log_array["log_date"] = date('Y-m-d H:i:s');
        $log_array["log_user"] = session("user.user_id");


        if (!$UserPowerFunc->checkUserPower(5)) {                    //权限验证
            return redirect()->back();  //跳回上一页     
        }

        //删除与当前用户Id想匹配的那条记录
        $count = DB::table('base_article_class')->where('class_id', '=', $class_id)->delete();
        if ($count == 0) {
            $baseFunc->setRedirectMessage(false, "删除失败", NULL, "/user_sClass");
        } else {
            $logFunc->insertLog($log_array);    //插入操作记录
            $baseFunc->setRedirectMessage(true, "删除成功", NULL, "/user_sClass");
        }
    }

    public function uClass(BaseFunc $baseFunc, LogFunc $logFunc, UserPowerFunc $UserPowerFunc) {

        //操作记录
        $log_array["log_level"] = 0;
        $log_array["log_title"] = "修改base_article_class表中的一条记录";
        $log_array["log_detail"] = "修改base_article_class表中的一条记录,只改变其中的class_name,class_update_date";
        $log_array["log_date"] = date('Y-m-d H:i:s');
        $log_array["log_user"] = session("user.user_id");

        $userId = session("user.user_id");
        $inputData = Request::only("class_id", "class_name");
        $inputData["class_update"] = date('Y-m-d H:i:s');
        $getData["article_class"] = DB::table('base_article_class')->get();

        $class = DB::table('base_article_class')->where('class_id', '=', $inputData["class_id"])->first();
        if ($class->class_user != $userId) {
            $baseFunc->setRedirectMessage(false, "此用户无权修改", NULL, "/user_sClass");
        }
        if (!$UserPowerFunc->checkUserPower(5)) {                    //权限验证
            return redirect()->back();  //跳回上一页     
        }

        $count1 = DB::table('base_article_class')->where('class_id', '=', $inputData["class_id"])->update(['class_name' => $inputData["class_name"], 'class_update_date' => date('Y-m-d H:i:s')]);   //修改 
        if ($count1 != 0) {
            $logFunc->insertLog($log_array);    //插入操作记录
        }
        $baseFunc->setRedirectMessage(true, "修改成功", NULL, "/user_sClass");     
    }

}
