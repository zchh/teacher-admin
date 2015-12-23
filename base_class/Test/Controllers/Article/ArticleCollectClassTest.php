<?php
/**
 * Created by PhpStorm.
 * User: yanghe
 * Date: 2015/12/21
 * Time: 22:15
 */
namespace BaseClass\Test\Controllers\Article;
use App\Http\Controllers\Controller;
use BaseClass\Component\Article\ArticleCollectClass;
class ArticleCollectClassTest extends Controller
{
    function addTest()
    {
        $info_array['class_name']="你好";
        $result=ArticleCollectClass::add($info_array);
        dump($result);
    }

    //按照用户获取所有的收藏夹
    function getMoreByUserTest()
    {
        $a=1;
        $result=ArticleCollectClass::getMoreByUser($a);
        dump($result);
    }

    //同步基本信息 和 在当前搜藏夹的信息，保存在$this->info 和$this->collect_list
    public function syncBaseInfoTest(){
        $a=new ArticleCollectClass(1);
        $result=$a->syncBaseInfo();
        dump($result);
    }
    public function syncArticleInfoTest()
    {
        $a= new ArticleCollectClass(3);
        $result=$a->syncArticleInfo();
        dump($result);

    }


    //更新信息
    public function updateTest()
    {
        $a=new ArticleCollectClass(1);
        $b['class_name']="good";
        $result=$a->update($b);
        dump($result);

    }

    //删除  ，user_id 可选，如果传入，要检查是否是这个用户的
    public function deleteTest()
    {
        $a=new ArticleCollectClass(1);
        $result=$a->delete();
        dump($result);
    }

}