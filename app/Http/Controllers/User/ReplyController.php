<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\ArticleFunc;
use App\Http\Middleware\PostCheck;
use GirdPlugins\Base\LogFunc;
class ReplyController extends Controller 
{


    //添加评论


    public function aReply(LogFunc $logFunc,BaseFunc $baseFunc)
    {
        //需要传入两个参数
        //文章名  父评论
        //dump($_POST);
        $recvData = Request::only("reply_article","reply_detail");
        $recvData["reply_create_date"] = date('Y-m-d H:i:s');
        $recvData["reply_user"] = session("user.user_id");
        
        DB::beginTransaction();

        $return_id = DB::table("base_article_reply")->insertGetId($recvData);
        
        $relationData["relation_parent"] = Request::input("reply_parent");
        $relationData["relation_child"] = $return_id;
        if(DB::table("base_reply_relation")->insert($relationData))
        {
            $baseFunc->setRedirectMessage(true, "添加评论成功", NULL);
            //在专题内移除文章之后添加此记录
            $log_array["log_level"]=2;
            $log_array["log_title"]="添加操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("user.user_nickname")."添加了一条评论";
            $log_array["log_data"]="添加";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            return redirect()->back();
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "添加评论失败", NULL);
            return redirect()->back();
        }  
    }
     //定义一个方法，构造一个树状数组
    public function tree($arr,$pid)
    {
        $res=array();
        foreach ($arr as $value) 
        {
            if($value->relation_parent == $pid)
            {
                $res[]=$value;
                $this->tree($arr,$value->reply_id);
            }
        }
        //dump($res);
        return $res;
        
    }
    //用户查看评论
    public function sReply()
    {
        session(["nowPage"=>"/user_sReply"]);
        //链表查询，查询当前用户的所有评论
        $input_data['reply_data'] = DB::table("base_article_reply")->leftJoin("base_article","reply_article","=","article_id")
                ->leftJoin("base_user","article_id","=","user_id")
                ->orderBy("reply_create_date","desc")->paginate(3);
        //$input_data['reply_data_by_articleId'] = $this->tree($reply_data,$pid=null);
        //dump($input_data);
        return view("User.Reply.sReply",$input_data);
    }
    //删除当前用户评论
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
                //在当前用户删除一条评论之后添加此记录
                $log_array["log_level"]=2;
                $log_array["log_title"]="删除操作";
                $log_array["log_detail"]=date("Y-m-d H:i:s").session("user.user_nickname")."删除了一条评论";
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

