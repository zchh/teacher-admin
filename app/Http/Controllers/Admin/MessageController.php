<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class MessageController extends Controller {

    public function sMessage() {
        session(["nowPage" => "/admin_sMessage"]);
        // dump(session("nowPage"));
        //从数据库提取数据，为获得发送方和接收方，需要合并三张表
      
        //管理员发送给用户
        $combine['base_message'] = DB::table('base_message')->join('base_admin', 'message_send_admin', '=', 'admin_id')->paginate(2);
        $combine['send_admin'] = session("admin.admin_id");  //获取管理员发送方id


        return view("Admin.Message.sMessage", $combine);
    }

    public function aMessage(BaseFunc $baseFunc) {
        $recv_user = $_POST['message_recv_user'];    //
        $gets = DB::table('base_user')->get();
        $i = 0;  //用于记录的增加
        foreach ($gets as $get) {
            if ($get->user_username == $recv_user) {   //判断此接收者名字是否存在
                //存在,就将数据插入
                $data['message_create_date'] = date('Y-m-d H:i:s');
                $data['message_title'] = $_POST['message_title'];
                $data['message_data'] = $_POST['message_data'];
                $data['message_recv_user'] = $get->user_id;     //插入的是id,//获取接收者名字的id
                $data['message_send_admin'] = session("admin.admin_id");  //获取管理员发送方Id
                if (DB::table('base_message')->insert($data)) {
                    $baseFunc->setRedirectMessage(true, "数据插入成功", NULL, "/admin_sMessage");
                    break;
                } else {
                    $baseFunc->setRedirectMessage(true, "数据插入失败", NULL, "/admin_sMessage");
                    break;
                }
            } else {
                $i ++;
            }
        }
        if ($i == count($gets)) {
            $baseFunc->setRedirectMessage(false, "此接收者不存在", NULL, "/admin_sMessage");
        }
    }

    public function dMessage($message_id, BaseFunc $baseFunc) {
        dump($message_id);
        $adminId = session("admin.admin_id");    //提取管理员id

        $get = DB::table('base_message')->where('message_send_admin', '=', $adminId)->where('message_id', '=', $message_id)->delete();
        if ($get == null) {
            $baseFunc->setRedirectMessage(false, "删除失败", NULL, "/admin_sMessage");
        } else {
            $baseFunc->setRedirectMessage(true, "删除成功", NULL, "/admin_sMessage");
        }
    }

}
