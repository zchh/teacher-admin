<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/9
 * Time: 14:10
 */

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use BaseClass\Component\Article\Article;
use BaseClass\Component\Article\ArticleClass;
use Illuminate\Support\Facades\Request;

class ArticleController extends Controller
{

    public function sArticle()
    {

        /*
         * $query_limit
         * |-start  起始
         * |-num    结束页数
         * |-class  类别
         * |-sort   排序
         * |-search 搜索关键字
         * |-user   特殊用户（不写检查所有用户，会检查是否有管理员权限，也可设置为0自动改成当前session用户）
         * |-reverse 是否逆转排序即倒序
         * |
         *
         *
         * $return_data
         * |-status 是否成功
         * |-message 消息
         * |-data   数据 DB返回的二维结构
         * */
        $query_limit = Request::input("query_limit");
        //如果没有session直接断掉
        if(session("user.user_id",NULL)==NULL)
        {
            $return_data["status"] = false;
            $return_data["message"] = "你没有权限查看";
            return response()->json($return_data);
        }
        //如果不匹配，检查是否为0，可以的话置为当前session
        if(session("user.user_id")!= $query_limit["user"])
        {
            if($query_limit["user"] == 0)
            {
                $query_limit["user"] = session("user.user_id");
            }
            else
            {
                $return_data["status"] = false;
                $return_data["message"] = "你不能看别人的！";
                return response()->json($return_data);
            }
        }
        $articleArray = Article::select($query_limit);


        return response()->json($articleArray);



    }

    public function dArticle()
    {
        $article_id = Request::input("article_id");
        $article = new Article($article_id);
        if($article->info->article_user == session("user.user_id"))
        {
            $article->delete();
            return response()->json(["status"=>true,"message"=>"完成删除"]);
        }
        else
        {
            return response()->json(["status"=>false,"message"=>"无法删除"]);
        }
    }
    public  function moreArticle()
    {}

    public function sArticleClass()
    {
        /*
         * $query_limit
         * |-user   按照用户筛选 （不写检查所有用户，会检查是否有管理员权限，也可设置为0自动改成当前session用户）
         * |-sort   排序方式
         * |-num    每页条数
         * |-start  开始
         * |-desc   是否倒序列
         *
         *

        * $return_data
        * |-status 是否成功
        * |-message 消息
        * |-data   数据 DB返回的二维结构
         * */
        $query_limit = Request::input("query_limit");
        //如果没有session直接断掉
        if(session("user.user_id",NULL)==NULL)
        {
            $return_data["status"] = false;
            $return_data["message"] = "你没有权限查看";
            return response()->json($return_data);
        }
        //如果不匹配，检查是否为0，可以的话置为当前session
        if(session("user.user_id")!= $query_limit["user"])
        {
            if($query_limit["user"] == 0)
            {
                $query_limit["user"] = session("user.user_id");
            }
            else
            {
                $return_data["status"] = false;
                $return_data["message"] = "你不能看别人的！";
                return response()->json($return_data);
            }
        }
        $articleArray = ArticleClass::select($query_limit);
        return response()->json($articleArray);

    }

    public function dArticleClass()
    {}

}