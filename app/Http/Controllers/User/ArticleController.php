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
}



