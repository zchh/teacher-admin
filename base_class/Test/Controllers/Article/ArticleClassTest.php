<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 16:50
 */

namespace BaseClass\Test\Controllers\Article;


use App\Http\Controllers\Controller;
use BaseClass\Component\Article\ArticleClass;
class ArticleClassTest extends Controller
{
    public function addTest()
    {
        $array_info['class_user']=21;
        $array_info['class_name']='李作强';
        ArticleClass::add($array_info);
    }
    public function getMoreByUserTest()
    {
        dump(ArticleClass::getMoreByUser(21));
    }
    public function updateTest()
    {
        $array_info['class_name']='hello2';
        $article_class=new ArticleClass(3);
        $article_class->update($array_info);
        dump($article_class);
    }
    public function deleteTest()
    {
        $article_class=new ArticleClass(4);
        $article_class->delete();
        dump($article_class);
    }
}