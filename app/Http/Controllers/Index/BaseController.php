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
        $results['article'] = DB::select('select * from base_article where article_title like :key', ['key' => $key]);
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
        //把用户昵称发过去
        
     
        $inputData['data']=DB::table('base_user')-> where('user_id','=', $user_id) ->first();//提取一条记录,获得用户昵称
        
        //获得当前用户的所有文章
        $inputData['article'] = DB::table('base_article')-> where('article_user','=', $user_id) ->get();
        
        
        return view("Index.User.userIndex",$inputData);
        
        
    }
    
    
    public function sSubject()    //得到所有专题，并列出来
    {
        $inputData['subject']  = DB::table('base_article_subject')->get();
        return view("Index.Subject.sSubject",$inputData);
    }
    
   public function moreSubject($subject_id)     //传递满足$subject_id的文章
    {
           $inputData['article_id'] =  DB::table('base_article_re_subject')->where('relation_subject','=',$subject_id)->get();//提取包含文章多个id
          // $article_id = $subject -> relation_subject;
           $inputData['article'] =  DB::table('base_article')->get();     
            
        return view("Index.Subject.moreSubject",$inputData);
    }
    
    public function articleDetail(ArticleFunc $articleFunc, $article_id)
    {
        
        //把文章详情传递过去
        
             session(["nowPage"=>null]);

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
        
        
        $combine["replyData"] = $articleFunc->getArticleReply($article_id);
        
        return view("Index.Article.articleDetail",$combine);
    }
}
