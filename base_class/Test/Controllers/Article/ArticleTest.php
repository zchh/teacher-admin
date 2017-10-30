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
use BaseClass\Component\Article\ArticleClass;

class ArticleTest extends Controller
{
    public function getMoreByUserTest()
    {
        $article=Article::getMoreByUser(1);
        dump($article);
    }
    public function getMoreBySubjectTest()
    {
        $subject = Article::getMoreBySubject(1);
        dump($subject);
    }
    public function addTest()
    {
        $inputData['article_user']=1;
        $inputData['article_title']="hello word";
        $inputData['article_intro']="hello hello word";
        $inputData['article_class']=1;
        $inputData['article_detail']="abcdefg";
        Article::add($inputData);
    }
    public function syncBaseInfoTest()
    {
        $a = new Article(1);
        $article = $a->syncBaseInfo();
        dump($article);
    }
    public function syncReplyInfoTest()
    {
        $a = new Article(1);
        $reply=$a->syncReplyInfo();
        dump($reply);
    }
    public function updateTest()
    {
        $a = new Article(1);
        $inputData['article_title']="hello word2222";
        $inputData['article_intro']="hello hello word2";
        $inputData['article_detail']="abcdefghijk222";
        $a->update($inputData);
        dump($a);
    }
    public function deleteTest()
    {
        $a = new Article(20);
        $a->delete();
    }
    public function test()
    {
        /*//测试 是否能按照用户查找
        session(["user"=>["user_id"=>1]]);
        $data["start"] = 1;
        $data["num"] = 0;
        $data["user"] = 1;
        dump(Article::select($data));

        //测试 是否能自由查找
        $data=null;
        $data["user"] = 1;
        $data["search"] = "p";
        dump(Article::select($data));
        //
        $data=null;
        $data["num"] = 0;

        dump(Article::select($data));*/

        //管理员查找依赖管理员，暂无
        dump(session("user"));dump(session("admin"));
        $data["user"] = 0;
        dump(ArticleClass::select($data));
    }
    public function angularTest()
    {
        return view("User.ngArticle.article");
    }
}