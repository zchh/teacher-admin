<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\ArticleFunc;
class ReplyController extends Controller 
{
    public function aReply(BaseFunc $baseFunc)
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
            DB::commit();
            $baseFunc->setRedirectMessage(true, "添加评论成功", NULL);
            return redirect()->back();
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "添加评论失败", NULL);
            return redirect()->back();
        }
        
        
        
        
    }

}
