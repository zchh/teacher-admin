<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use GirdPlugins\Base\ArticleFunc;
use GirdPlugins\Base\BaseFunc;

class MessageController extends Controller {

    public function sMessage() {
        session(["nowPage" => "/user_sMessage"]);
        // dump(session("nowPage"));
        //从数据库提取数据，为获得发送方和接收方，需要合并三张表
        //用户发送给用户
        $combine['base_message'] = DB::table('base_message')->join('base_user', 'message_recv_user', '=', 'user_id')->get();
        $combine['send_user'] = session("user.user_id");  //获取发送方id


        /*
          $combine['base_image'] = DB::table('base_image')    //为了获得图片用户，要合并两张表
          ->join('base_user', 'base_image.image_user', '=', 'base_user.user_id')->paginate(6); //分页，两条记录一页
          // $data['base_image'] = DB::table('base_image')->get();

         */

        return view("User.Message.sMessage", $combine);
    }

    public function aMessage(BaseFunc $baseFunc) 
    {
        $recv_user = $_POST['message_recv_user'];
        $gets = DB::table('base_user')->get();
        foreach ($gets as $get) {
            if ($get->user_username == $recv_user) {   //判断此接收者名字是否存在
                //存在,就将数据插入
                $data['message_create_date'] = date('Y-m-d H:i:s');
                $data['massege_title'] = $_POST['message_title'];
                $data['message_data'] = $_POST['message_data'];
                $data['message_recv_user'] = $_POST['message_recv_user'];
                $data['message_send_user'] = session("user.user_id");
                if (DB::table('base_message')->insert($data)) {
                    $baseFunc->setRedirectMessage(true, "数据插入成功", NULL, "/user_sMessage");
                    break;
                } else {
                    $baseFunc->setRedirectMessage(true, "数据插入失败", NULL, "/user_sMessage");
                    break;
                }
            } else {
                $baseFunc->setRedirectMessage(false, "此接收者名不存在", NULL, "/user_sMessage");
                break;
            }
        }
    }
    
    
    
    
    

}
