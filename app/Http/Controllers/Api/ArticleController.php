<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/9
 * Time: 14:10
 */

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use BaseClass\Role\User;
use BaseClass\Component\Article\Article;
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
        return response()->json($articleArray);

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
}