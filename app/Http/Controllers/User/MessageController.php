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

class MessageController extends Controller {

    public function sMessage() {
        session(["nowPage" => "/user_sMessage"]);
        // dump(session("nowPage"));
        //从数据库提取数据，为获得发送方和接收方，需要合并三张表
        //用户发送给用户
        //管理员发送给用户
        $combine['base_message'] = DB::table('base_message')->join('base_user', 'message_recv_user', '=', 'user_id')->paginate(2);
        $combine['send_user'] = session("user.user_id");  //获取用户发送方id


        return view("User.Message.sMessage", $combine);
    }

    public function aMessage(BaseFunc $baseFunc, LogFunc $logFunc, UserPowerFunc $UserPowerFunc) {

        //操作记录
        $log_array["log_level"] = 0;
        $log_array["log_title"] = "向base_message表中插入一条记录";
        $log_array["log_detail"] = "向base_message表中插入一条记录";
        $log_array["log_date"] = date('Y-m-d H:i:s');
        $log_array["log_user"] = session("user.user_id");

        if (!$UserPowerFunc->checkUserPower(9)) {                    //权限验证
            return redirect()->back();  //跳回上一页     
        }


        $recv_user = $_POST['message_recv_user'];
        $gets = DB::table('base_user')->get();
        $i = 0;  //用于记录的增加
        foreach ($gets as $get) {
            if ($get->user_username == $recv_user) {   //判断此接收者名字是否存在
                //存在,就将数据插入
                $data['message_create_date'] = date('Y-m-d H:i:s');
                $data['message_title'] = $_POST['message_title'];
                $data['message_data'] = $_POST['message_data'];
                $data['message_recv_user'] = $get->user_id;     //插入的是id,//获取接收者名字的id
                $data['message_send_user'] = session("user.user_id");
                if (DB::table('base_message')->insert($data)) {
                    $logFunc->insertLog($log_array);    //插入操作记录
                    $baseFunc->setRedirectMessage(true, "数据插入成功", NULL, "/user_sMessage");
                    break;
                } else {
                    $baseFunc->setRedirectMessage(true, "数据插入失败", NULL, "/user_sMessage");
                    break;
                }
            } else {
                $i ++;
            }
        }
        if ($i == count($gets)) {
            $baseFunc->setRedirectMessage(false, "此接收者不存在", NULL, "/user_sMessage");
        }
    }

    public function dMessage($message_id, BaseFunc $baseFunc, LogFunc $logFunc, UserPowerFunc $UserPowerFunc) {

        //操作记录
        $log_array["log_level"] = 0;
        $log_array["log_title"] = "删除base_message表一条记录";
        $log_array["log_detail"] = "删除base_message表一条记录";
        $log_array["log_date"] = date('Y-m-d H:i:s');
        $log_array["log_user"] = session("user.user_id");

        if (!$UserPowerFunc->checkUserPower(9)) {                    //权限验证
            return redirect()->back();  //跳回上一页     
        }

        $userId = session("user.user_id");    //提取用户id

        $get = DB::table('base_message')->where('message_send_user', '=', $userId)->where('message_id', '=', $message_id)->delete();
        if ($get == null) {
            $baseFunc->setRedirectMessage(false, "删除失败", NULL, "/user_sMessage");
        } else {
            $logFunc->insertLog($log_array);    //插入操作记录
            $baseFunc->setRedirectMessage(true, "删除成功", NULL, "/user_sMessage");
        }
    }

    public function readSingleMessage($message_id, BaseFunc $baseFunc) {

        session(["nowPage" => "/user_sMessage"]);
        // dump(session("nowPage"));
        //从数据库提取数据，为获得发送方和接收方，需要合并三张表
        //用户发送给用户
        //管理员发送给用户
        $inputData['singleData'] = DB::table('base_message')->where('message_id', '=', $message_id)->first();


        return view("User.Message.readSingleMessage", $inputData);
    }

}
