<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use BaseClass\Component\Article\ArticleReply;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
class ReplyController extends Controller 
{


    //添加评论


    public function aReply(BaseFunc $baseFunc)
    {
        //需要传入两个参数
        //文章名  父评论
        //dump($_POST);exit();

        $recvData = Request::only("reply_article","reply_detail");
        $recvData["reply_create_date"] = date('Y-m-d H:i:s');
        $recvData["reply_user"] = session("user.user_id");

        $return_id = ArticleReply::addReply($recvData);
        if($return_id == false)
        {
            $baseFunc->setRedirectMessage(false, "添加评论失败", NULL);
            return redirect()->back();
        }
        if(Request::input("reply_parent",null) != null)
        {
            $relationData["relation_parent"] = Request::input("reply_parent");
        }

        $relationData["relation_child"] = $return_id;

        if(empty($relationData["relation_parent"]))
        {
            $parent = DB::table("base_article")
                ->where("article_id","=",$recvData["reply_article"])
                ->first();
            $parent = $parent->article_user;
        }
        else
        {
            $reply_limit["reply_id"] = $relationData["relation_parent"];
            $reply_limit["first"] = true;
            $replyArr =  ArticleReply::select($reply_limit);
            $parent = $replyArr["data"] -> reply_user;

        }

          $return = ArticleReply::addRelation($relationData);
        if($return == true)
        {
            DB::table('base_article')->where("article_id","=",$recvData["reply_article"])->increment('article_reply');
            /*
            DB::table("base_message")->insert(["message_send_admin"=>1,
                "message_recv_user"=>$parent,
                "message_title"=>session("user.user_nickname")." 评论了你，快去看看吧",
                "message_create_date"=>  date('Y-m-d H:i:s') ,
                "message_read"=>0,
                "message_data"=>"".session("user.user_nickname")." 评论了你 <br>链接"
                    . " <a href='/index_articleDetail/".$recvData["reply_article"]."'>点击跳转</a>"
                    . "<br>内容如下<br>".$recvData["reply_detail"]
            ]);
            */
            $baseFunc->setRedirectMessage(true, "添加评论成功", NULL);
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

        $reply_limit["join_article_and_user"] = true;
        $reply_limit["sort"] = "reply_create_date";
        $reply_limit["desc"] = true;
        $reply_limit["paginate"] = 10;

        $replyArr = ArticleReply::select($reply_limit);
        $input_data['reply_data'] = $replyArr["data"];

        return view("User.Reply.sReply",$input_data);

    }
    //删除当前用户评论
    public function dReply(BaseFunc $baseFunc,$reply_id)
    {
        DB::beginTransaction();

            $reply = new ArticleReply($reply_id);
            $return = $reply ->delete();
            if($return == true)
            {
                $baseFunc->setRedirectMessage(true, "删除评论成功", NULL);
                DB::commit();
                return redirect()->back();
            }
            else
            {
                $baseFunc->setRedirectMessage(false, "删除评论失败", NULL);
                return redirect()->back();

            }
    }



}

