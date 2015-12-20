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
    public function getMoreByUserTest()
    {
        $result=Article::getMoreByUser(1);
//        dump($result);
//        exit();
    }
    public function getMoreBySubjectTest()
    {
       $result=Article::getMoreBySubject(1);
//        dump($result);
//        exit();
    }
    public function addTest()
    {
        $a['article_title']="hahahahh";
        $a['article_intro']="mninidsaidsahuidhsauidhsandiu";
        $a['article_detail']="iasdjsadjsaiodjsaoi";
        $result=Article::add($a);
//        dump($result);
//        exit();
    }
    public function syncBaseInfoTest()
    {
    $a=new Article(1);
        $result=$a->syncBaseInfo();
//        dump($result);
//        exit();
    }
    public function syncReplyInfoTest()
    {
       $a=new Article(1);
        $result=$a->syncReplyInfo();
//        dump($result);
//        exit();
    }
    public function updateTest()
    {
       $data['article_title']="给了";
        $a=new Article(21);
        $result=$a->update($data);
//        dump($result);
//        exit();

    }
    public function deleteTest()
    {
        $a=new Article(21);
        $result=$a->delete();
//        dump($result);
//        exit();
    }
}