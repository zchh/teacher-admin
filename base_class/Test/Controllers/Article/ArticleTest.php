<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 16:50
 */

namespace BaseClass\Test\Controllers\Article;


use App\Http\Controllers\Controller;

class ArticleTest extends Controller
{
    public function test()
    {
        echo "Article test";
    }
    public function angularTest()
    {
        return view("User.ngArticle.base");
    }
}