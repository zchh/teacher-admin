<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\ArticleFunc;
class ArticleController extends Controller 
{
    public function sArticle()
    {
        return view("User.Article.sArticle");
    }
    public function aArticle(ArticleFunc $atcFunc,  BaseFunc $baseFunc)
    {
        $inputData["articleClass"] = $atcFunc->getUserClass(session("user.user_id"));
        $inputData["ajaxRequest"] = $baseFunc->requestAjax(
        ["article_title","article_intro","article_class","article_sort","article_detail"],
                "submitForm", "_user_aArticle",true);
        return view("User.Article.aArticle",$inputData);
    }
    public function _aArticle(ArticleFunc $atcFunc)
    {
        $articleData = Request::only("article_title","article_intro","article_class","article_sort","article_detail");
        $atcFunc->addArticle($articleData);
        
    }
    
    
    public function readAllArticle()
    {
        //获得用户id
         $baseArticle = DB::table('base_article')->get();  //返回值为数组
         $inputData["articleData"] = $baseArticle;
         return view("User.Article.readAllArticle",$inputData);
    }
    public function readSingleArticle($article_id)
    {
        
        //获取文章id，在页面输出这个id对应的各种内容
        // $inputData["articleData"] = DB::table('base_article')->get();  //返回值为数组，数组中包含多个类对象，一个对象为一个记录
         
         //$inputData["article_id"] = $article_id;
         
          $combine["articleData"] = DB::table('base_article')    //为了获得作者，要合并两张表
          ->join('base_user', 'base_article.article_user', '=', 'base_user.user_id')
          ->get();

          $combine["article_id"] = $article_id;    //获取路由上的article_id
  
        foreach ($combine["articleData"] as $key => $data)
        {
            if($data -> article_id == $article_id)
            {
              $i = $key;                       //获取是路由id的数组下标
              break;
            }
        }
        $record = count($combine);   //记录条数
       
        $i==$record-1? $combine["nextArticle"]=-1 :$combine["nextArticle"]=$combine["articleData"][$i+1]->article_id;//
        $i==0? $combine["previousArticle"]=-1 :$combine["previousArticle"]=$combine["articleData"][$i-1]->article_id;
        $combine["record"] = $record;
       
         return view("User.Article.readSingleArticle",$combine);    
         
         
    }
}


