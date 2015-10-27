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
        $record = count($combine["articleData"]);   //记录条数
       
        $i==$record-1? $combine["nextArticle"]=-1 :$combine["nextArticle"]=$combine["articleData"][$i+1]->article_id;//为-1,相当于为空
        $i==0? $combine["previousArticle"]=-1 :$combine["previousArticle"]=$combine["articleData"][$i-1]->article_id;
        $combine["record"] = $record;
        
         return view("User.Article.readSingleArticle",$combine);   
         
         
         
    }
    
    
    
}



    

    

