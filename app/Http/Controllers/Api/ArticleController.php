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
         * |-user   特殊用户（会检查是否有管理员权限）
         * |-reverse 是否逆转排序即倒序
         * |*/
        $articleArray = Article::select(Request::input("query_limit"));
        if($articleArray!==false)
        {
            $return_data["status"] = true;
            $return_data["message"] = "成功获取到数据";
            $return_data["data"] = $articleArray;
            return response()->json($return_data);
        }
        else
        {
            $return_data["status"] = false;
            $return_data["message"] = "获取数据失败，没有权限";

            return response()->json($return_data);
        }


    }
    public function aArticle()
    {

    }
    public function dArticle()
    {

    }
    public function uArticle()
    {

    }

    public function sArticleClass()
    {
        /*
         * $query_limit
         * |-user   按照用户筛选
         * |-sort   排序方式
         * |-num    每页条数
         * |-start  开始
         * |-desc 是否倒序列
         *
         */
        $classArray = ArticleClass::select(Request::input("query_limit"));
        if($classArray!==false)
        {
            $return_data["status"] = true;
            $return_data["message"] = "成功获取到数据";
            $return_data["data"] = $classArray;
            return response()->json($return_data);
        }
        else
        {
            $return_data["status"] = false;
            $return_data["message"] = "获取数据失败，没有权限";

            return response()->json($return_data);
        }
    }

}