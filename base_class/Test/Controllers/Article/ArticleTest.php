<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 16:50
 */

namespace BaseClass\Test\Controllers\Article;


use App\Http\Controllers\Controller;
use BaseClass\Component\Article\Article;

class ArticleTest extends Controller
{
    public function test()
    {
        //测试 是否能按照用户查找
        session(["user"=>["user_id"=>1]]);
        $data["start"] = 1;
        $data["num"] = 1;
        $data["user"] = 1;
        dump(Article::select($data));

        //测试 是否能自由查找
        $data=null;
        $data["user"] = 1;
        $data["search"] = "机";
        dump(Article::select($data));

        //管理员查找依赖管理员，暂无
    }
    public function angularTest()
    {
        return view("User.ngArticle.article");
    }
}