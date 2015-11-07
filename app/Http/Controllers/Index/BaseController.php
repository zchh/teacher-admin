<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\ArticleFunc;   //张池增加
class BaseController extends Controller {
    public function index()  
    {
        $inputData['articleData'] = DB::table("base_article")->get();
        
        return view("Index.index",$inputData);
    }
    
    
    //从前端输入框获得一个名字为key的输入框，key 就是输入的文章名
   //用此文章名，要打印出关于此文章的所有信息的一个框
  //其中包括查看详情，点击则可以进入详情页面
    public function findArticle()  
    {
      // dump($_GET);
        
        $key = "%".$_GET["key"]."%";
       // $inputData['article'] = DB::table('base_article')-> where('article_title','=','') ->first();
        $results['articleData'] = DB::select('select * from base_article where article_title like :key', ['key' => $key]);
      // dump($results);
      //exit();
       return view("Index.Article.findArticle",$results);
    }
    
    
    public function sArticle()
    {
        return view("Index.sArticle");
    }
    
    public function userIndex($user_id)  //用户首页
    {
        //获取用户信息
        $inputData['userData']=DB::table('base_user')-> where('user_id','=', $user_id) ->first();//提取一条记录,获得用户昵称
        
        //获得当前用户的所有文章
        $inputData['articleData'] = DB::table('base_article')-> where('article_user','=', $user_id)->
                orderBy("article_id","desc")->get();
        //获取当前用户的专题
        $inputData["subjectData"] = DB::table("base_article_subject")-> where('subject_user','=', $user_id)->
                orderBy("subject_id","desc")->get();
        
        return view("Index.User.userIndex",$inputData);
        
        
    }
    
    
    public function sSubject()    //得到所有专题，并列出来
    {
        $inputData['subject']  = DB::table('base_article_subject')->get();
        return view("Index.Subject.sSubject",$inputData);
    }
    
   public function moreSubject($subject_id)     //传递满足$subject_id的文章
    {
           $inputData['articleData'] =  DB::table('base_article_re_subject')
                   ->leftJoin("base_article","article_id","=","relation_article")
                   ->where('relation_subject','=',$subject_id)
                   ->orderBy("relation_sort")->get();//提取包含文章多个id
          // $article_id = $subject -> relation_subject;
           $inputData['subjectData'] =  DB::table('base_article_subject')
                   ->where("subject_id","=",$subject_id)
                   ->first();     
            
           $inputData["userInfoGui"] = $this->userSider($inputData["subjectData"]->subject_user);;
           return view("Index.Subject.moreSubject",$inputData);
        
    }
    
    public function articleDetail(ArticleFunc $articleFunc, $article_id)
    {
        
        $viewData["articleData"] = DB::table('base_article')
                  ->where("article_id","=",$article_id)
                  ->leftJoin("base_user","user_id","=","article_user")
                  ->first();
        $viewData["choseData"] =NULL;
        
        $viewData["replyData"] = $articleFunc->getArticleReply($article_id);
        $viewData["userInfoGui"] = $this->userSider($viewData["articleData"]->article_user);
        return view("Index.Article.articleDetail",$viewData);
       
    }
    
    
    //用户侧栏组件
    private function userSider($user_id)
    {
        $viewData["userData"] =  DB::table('base_user')
                  ->where("user_id","=",$user_id)
                  //->leftJoin("base_article","user_id","=","article_user")
                  ->first();
         return view("Index.User.userSider",$viewData);
    }
}
