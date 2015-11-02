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


        /*彭亮请清理你的代码
     //定义一个方法，构造一个树状数组
    public function tree($arr,$pid)
    {
        $res=array();
        foreach ($arr as $value) 
        {
            if($value->relation_parent == $pid)
            {
                $res[]=$value;
                $this->tree($arr, $value->reply_id);
            }
        }
        return $res;
    }
    //得到所有的回复信息（连表查询），构成数组
    public function sReply()
    {
        $reply_data = DB::table("base_article_reply")->leftJoin("base_reply_relation","reply_id","=","relation_parent")->get();
        $input_data['reply_data_by_articleId'] = $this->tree($reply_data, $pid=null);
        dump($input_data);
    }
    //用于评论之后把评论信息插入评论表
    public function aReply()
    {
        $input_data = Request::only("reply_article","reply_detail");
        $input_data['reply_create_date']=date("Y-m-d H:i:s");
        $input_data['reply_user']=  session("user_id");
        DB::beginTransaction();
        if(DB::table("base_article_reply")->insert($input_data))
        {
            
        }
    }*/

}
