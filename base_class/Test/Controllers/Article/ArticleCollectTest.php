<?php
/**
 * Created by PhpStorm.
 * User: yanghe
 * Date: 2015/12/21
 * Time: 19:18
 */
namespace BaseClass\Test\Controllers\Article;
use App\Http\Controllers\Controller;
use BaseClass\Component\Article\ArticleCollect;
class ArticleCollectTest extends Controller
{
    function select($query_limit)
    {

    }


    function addTest()
    {
        $a=new ArticleCollect(1);
        $info_array['collect_article_id']=22;
        $info_array['collect_class']=1;
        $result=$a->add($info_array);
        dump($result);
    }

    public function syncBaseInfoTest()
    {
        $a=new ArticleCollect(22);
        $result=$a->syncBaseInfo();
        dump($result);
    }


    public function updateTest()
    {
        $info_array['collect_class']=1;
        $a=new ArticleCollect(6);
        $result=$a->update($info_array);
        dump($result);
    }

    public function deleteTest()
    {
        $a=new ArticleCollect(6);
        $result=$a->delete();
        dump($result);

    }
}


