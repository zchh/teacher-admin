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
    public function sArticle(ArticleFunc $atcFunc)
    {
       
        $articleData = $atcFunc->getUserArticle(session("user.user_id"));
        $inputData["articleData"] = $articleData;
        session(["nowPage"=>"/user_sArticle"]);
        return view("User.Article.sArticle",$inputData);
    }
    public function aArticle(ArticleFunc $atcFunc,  BaseFunc $baseFunc)
    {
        
        session(["nowPage"=>"/user_aArticle"]);
        //dump(session("nowPage"));
        $inputData["articleClass"] = $atcFunc->getUserClass(session("user.user_id"));
        /*$inputData["ajaxRequest"] = $baseFunc->requestAjax(
        ["article_title","article_intro","article_class","article_sort"],
                "submitForm", "_user_aArticle",true);*/
       
        return view("User.Article.aArticle",$inputData);
        
    }
    public function _aArticle(ArticleFunc $atcFunc,  BaseFunc $baseFunc)
    {
        
        $articleData = Request::only("article_title","article_intro","article_class","article_sort","article_detail");
        if(true == $atcFunc->addArticle($articleData))
        {
            /*$data = $baseFunc->responseAjax("成功", "成功添加文章", '<script language="javascript" type="text/javascript">
                window.location.href="/user_sArticle";
                </script>');*/
           // $baseFunc->setRedirectMessage(true, "成功添加文章,即将跳转",NULL);
            return "完成添加";
        }
        else
        {
            //$data  = $baseFunc->responseAjax("失败", "无法添加文章", NULL);
            return "无法添加";
            
        }
        
    }
    public function dArticle($articleId,ArticleFunc $atcFunc,  BaseFunc $baseFunc)
    {
        if($atcFunc->deleteUserArticle(session("user.user_id"),$articleId))
        {
            $baseFunc->setRedirectMessage(true, "成功删除", NULL,"/user_sArticle");
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "删除失败", NULL,"/user_sArticle");
        }
    }
    public function uArticle($articleId,ArticleFunc $atcFunc,  BaseFunc $baseFunc)
    {
        session(["nowPage"=>"/user_uArticle"]);
        $inputData["articleClass"] = $atcFunc->getUserClass(session("user.user_id"));
        $inputData["ajaxRequest"] = $baseFunc->requestAjax(
        ["article_title","article_intro","article_class","article_sort","article_detail"],
                "submitForm", "/_user_uArticle",true);
        $inputData["articleDetail"] = $atcFunc->getArticleDetail($articleId);
        return view("User.Article.uArticle",$inputData);
        
    }
    public function ajax_getNowArticleDetail(ArticleFunc $atcFunc)
    {
        $data = Request::only("article_id");
        echo $atcFunc->getArticleDetail( $data["article_id"])->article_detail;
    }
    public function _uArticle() 
   {
        $articleData = Request::only("article_title","article_intro","article_class","article_sort","article_detail");
        $articleId = Request::input("article_id");
        if(DB::table("base_article")->where("article_id","=",$articleId)
                ->where("article_user","=",session("user.user_id"))
                ->update($articleData))
        {
            return response()->json(['status' => true, 'message' => '<p class="text-success">修改成功，即将跳转</p>']);
        }
        else
        {
            return response()->json(['status' => false, 'message' => '<p class="text-danger">失败，请检查</p>']);
        }
    }
    

    
}



