<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use GirdPlugins\Base\ArticleFunc;
use GirdPlugins\Base\BaseFunc;
use GirdPlugins\Base\LogFunc;      //zc
use GirdPlugins\Base\UserPowerFunc;      //zc

class ImageController extends Controller {

    public function sImage() {
        session(["nowPage" => "/user_sImage"]);
        $combine['base_image'] = DB::table('base_image')    //为了获得图片用户，要合并两张表
                        ->join('base_user', 'base_image.image_user', '=', 'base_user.user_id')->paginate(6); //分页，两条记录一页
        return view("User.Image.sImage", $combine);
    }

    public function aImage(BaseFunc $baseFunc, LogFunc $logFunc, UserPowerFunc $UserPowerFunc) {   //增加图片

        dump(Request::all());
        if (!request::hasFile('image_file')) {
            $baseFunc->setRedirectMessage(false, "错误，上传失败", NULL);
            return redirect()->back();  //跳回上一页
        } else {
            //从前端提取文件
            $file = Request::file('image_file');

            //提取文件名
            $fileName = $file->getClientOriginalName();


            //移动文件到指定目录
            $path = $_SERVER['DOCUMENT_ROOT'] . "/file/";  //存贮文件的绝对路径
            $name = date('YmdHis') . session("user.user_id") . rand(1000, 9999) . "." . $file->getClientOriginalExtension();  //自动生成路径


            Request::file('image_file')->move($path, $name);  //
            //把文件相关数据插入数据库
            $input_data["image_name"] = $_POST["image_name"];  //改文件名1
            $input_data["image_format"] = $file->getClientOriginalExtension();   //文件格式
            $input_data["image_intro"] = $_POST["image_intro"];
            $input_data["image_path"] = "/file/" . $name;  //绝对路径
            $input_data["image_user"] = session("user.user_id");

            //操作记录
            $log_array["log_level"] = 0;
            $log_array["log_title"] = "向base_image表中插入一条记录";
            $log_array["log_detail"] = "向base_image表中插入一条记录";
            $log_array["log_date"] = date('Y-m-d H:i:s');
            $log_array["log_user"] = session("user.user_id");


            if (!$UserPowerFunc->checkUserPower(7)) {                    //权限验证
                $baseFunc->setRedirectMessage(false, "错误，无权限", NULL);
                return redirect()->back();  //跳回上一页
            }
            if (DB::table("base_image")->insert($input_data)) {
                $baseFunc->setRedirectMessage(true, "数据插入成功", NULL);
                $logFunc->insertLog($log_array);    //插入操作记录
                return redirect()->back();  //跳回上一页
            } else {
                $baseFunc->setRedirectMessage(false, "数据库查找失败", NULL);
                return redirect()->back();  //跳回上一页
            }
        }
    }

    public function dImage($image_id, BaseFunc $baseFunc, LogFunc $logFunc, UserPowerFunc $UserPowerFunc) {

        //1.先删除数据库的,用事务回滚，方便之后如果删了还可以恢复。删的同时要把image_id，路径提取出来
        DB::beginTransaction();    //提交事务
        //提取image_id，为之后删除文件做铺垫
        $userId = session("user.user_id");    //提取用户id
        //记录操作
        $log_array["log_level"] = 0;
        $log_array["log_title"] = "删除base_image表中的一条记录";
        $log_array["log_detail"] = "删除base_image表中的一条记录";
        $log_array["log_date"] = date('Y-m-d H:i:s');
        $log_array["log_user"] = session("user.user_id");

        $get = DB::table('base_image')->where('image_user', '=', $userId)->where('image_id', '=', $image_id)->first(); //要保证只能删自己用户的，不能删他人的
        if ($get == null) {
            $baseFunc->setRedirectMessage(false, "此用户无权限删除", NULL, "/user_sImage");
        }
        $getId = $get->image_id;  //提取image_id
        $getPath = $get->image_path;  //提取路径

        if (!$UserPowerFunc->checkUserPower(7)) {           //权限验证
            return redirect()->back();  //跳回上一页     
        }
        $count = DB::table('base_image')->where('image_user', '=', $userId)->where('image_id', '=', $image_id)->delete();  //先删数据库的
        if ($count == 0) {
            $baseFunc->setRedirectMessage(false, "删除数据库文件失败", NULL);
            return redirect()->back();  //跳回上一页
        }
        //2.删文件里的  
        if ($image_id == $getId) {
            if (unlink($_SERVER['DOCUMENT_ROOT'] . $getPath)) { //unlink是删除里面的路径
                DB::commit();     //提交事务：
                $baseFunc->setRedirectMessage(true, "删除文件成功", NULL);
                $logFunc->insertLog($log_array);    //插入操作记录
                return redirect()->back();  //跳回上一页
            } else {
                $baseFunc->setRedirectMessage(false, "删除文件失败", NULL);
                return redirect()->back();  //跳回上一页
            }
        }
    }

    public function uImage(BaseFunc $baseFunc, LogFunc $logFunc, UserPowerFunc $UserPowerFunc) {
        $inputData = Request::only("image_id", "image_intro", "image_name");
        $userId = session("user.user_id");    //提取用户id
        //记录操作
        $log_array["log_level"] = 0;
        $log_array["log_title"] = "修改base_image表中的一条记录";
        $log_array["log_detail"] = "修改base_image表中的一条记录,只修改image_name,image_intro其中一个或者都修改了";
        $log_array["log_date"] = date('Y-m-d H:i:s');
        $log_array["log_user"] = session("user.user_id");


        // 只改数据库的
        $image = DB::table('base_image')->where('image_id', '=', $inputData["image_id"])->first();
        if ($image->image_user != $userId) {
            $baseFunc->setRedirectMessage(false, "此用户无权修改此文件", NULL, "/user_sImage");
        }
        if (!$UserPowerFunc->checkUserPower(7)) {           //权限验证
            return redirect()->back();  //跳回上一页     
        }
        $count = DB::table('base_image')->where('image_user', '=', $userId)->where('image_id', '=', $inputData["image_id"])->update(['image_intro' => $inputData["image_intro"], 'image_name' => $inputData["image_name"]]);   //修改图片介绍
        if ($count != 0) {
            $logFunc->insertLog($log_array);    //插入操作记录
        }

        $baseFunc->setRedirectMessage(true, "修改文件成功", NULL, "/user_sImage");
    }

    public function sImageInFrame() {
        $inputData["image"] = DB::table('base_image')->where("image_user", "=", session("user.user_id"))->get();    //传递图片过去以供用户选择文章封面，zc
        $nowChoseImageId = session("image.image_id");
        if ($nowChoseImageId != NULL) {
            $nowChoseImageData = DB::table("base_image")->where("image_id", "=", $nowChoseImageId)->first();
            $inputData["nowChoseImageSrc"] = $nowChoseImageData->image_path;
        } else {
            $inputData["nowChoseImageSrc"] = NULL;
        }


        return view("User.Image.sImageInFrame", $inputData);
    }

    public function sImageIdInFrame($image_id, BaseFunc $baseFunc) {
        //判断是否是此用户，判断是否是此image_id的照片

        if ($image_id != null) {
            $userId = session("user.user_id");
            $get = DB::table('base_image')->where('image_user', '=', $userId)->where('image_id', '=', $image_id)->first(); //要保证只能选择自己用户的
            if ($get == null) {
                $baseFunc->setRedirectMessage(false, "此用户无权选择此图片", NULL);
                return redirect()->back();
            }
            $inputData["image_id"] = $image_id;
            session(["image" => $inputData]);
        } else {
            $inputData["image_id"] = null;
            session(["image" => $inputData]);
        }
        return redirect()->back();
    }

}
