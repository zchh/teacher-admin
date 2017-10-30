<?php
/**
 * Created by PhpStorm.
 * User: yanghe
 * Date: 2015/12/17
 * Time: 22:12
 */


namespace BaseClass\Test\Controllers\Article;


use App\Http\Controllers\Controller;
use BaseClass\Component\Article\ArticleSubject;
use Illuminate\Support\Facades\DB;

class ArticleSubjectTest extends Controller
{

     public function getMoreByUserTest()
    {
        $user_id=1;
        $result=ArticleSubject::getMoreByUser($user_id);
//                   dump($result);
//           exit();
    }

      public function addTest()
       {
            $data["subject_name"]='哈哈';
           $data["subject_intro"]='噢噢噢噢';
           $result=ArticleSubject::add($data);
//           dump($result);
//           exit();
       }


       public function syncBaseInfoTest()
       {
         $a=new ArticleSubject(1);
           $result=$a->syncBaseInfo();
           dump($result);
           exit();

       }
      public function syncArticleInfoTest()
       {
          $a=new ArticleSubject(1);
           $result=$a->syncArticleInfo();
//           dump($result);
//           exit();
       }

       public function SubjectUpdateTest()
       {
           $data["subject_name"]='哈哈';
           $data["subject_intro"]='噢噢噢噢';
           $a=new ArticleSubject(16);
           $result=$a->SubjectUpdate($data);
           dump($result);
           exit();



       }

       public function SubjectDeleteTest()
       {
           $a=new ArticleSubject(16);
           $result=$a->SubjectDelete();
//           dump($result);
//           exit();
       }

       public function SubjectAddArticleTest()
       {
        $a=new ArticleSubject(19);
           $relation_article=16;
           $result=$a->SubjectAddArticle($relation_article);
//           dump($result);
//           exit();
       }

       public function SubjectRemoveArticleTest()
       {
           $a=new ArticleSubject(19);
           $relation_article=16;
           $result=$a->SubjectRemoveArticle($relation_article);
//             dump($result);
//             exit();

       }

}