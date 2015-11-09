<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\PostCheck;  
use GirdPlugins\Base\LogFunc;
class ReplyController extends Controller {
    public function sReply()
    {
        session(["now_address"=>"/admin_sReply"]);
        //链表查询，查询所有用户的评论
        $input_data['reply_data'] = DB::table("base_article_reply")->leftJoin("base_article","reply_article","=","article_id")
                ->leftJoin("base_user","article_id","=","user_id")
                ->orderBy("reply_create_date","desc")->paginate(3);
        //$input_data['reply_data_by_articleId'] = $this->tree($reply_data,$pid=null);
        //dump($input_data);
        return view("Admin.Reply.sReply",$input_data);
    }
    //根据id删除用户评论
    public function dReply(LogFunc $logFunc,BaseFunc $baseFunc,$reply_id)
    {
        $reply_relationData_by_replyId = DB::table("base_reply_relation")->where("relation_child","=",$reply_id)->first();
        DB::beginTransaction();
        
        if(DB::table("base_reply_relation")->where("relation_id","=",$reply_relationData_by_replyId->relation_id)->delete())
        {
            //删除依耐表中对应字段
            if(DB::table("base_article_reply")->where("reply_id","=",$reply_id)->delete())
            {
                $baseFunc->setRedirectMessage(true, "删除评论成功", NULL);
                //在添加文章到专题之后添加此记录
                $log_array["log_level"]=0;
                $log_array["log_title"]="删除操作";
                $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."删除了一条用户评论";
                $log_array["log_data"]="删除";
                $log_array["log_admin"]=session("admin.admin_id");
                $logFunc->addLog($log_array);
                DB::commit();
                return redirect()->back();
            }
            else
            {
                $baseFunc->setRedirectMessage(false, "删除评论失败", NULL);
                return redirect()->back();
            }
        }
        else
        {
            $baseFunc->setRedirectMessage(true, "删除评论失败", NULL);
            return redirect()->back();
        }
        
    }
}

