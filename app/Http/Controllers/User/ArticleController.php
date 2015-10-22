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
    public function readSingleArticle()
    {
        //获取文章id，在页面输出这个id对应的各种内容
         $baseArticle = DB::table('base_article')->get();  //返回值为数组，数组中包含多个类对象，一个对象为一个记录
         $inputData["articleData"] = $baseArticle;
         return view("User.Article.readSingleArticle");     
         
         
    }
}



