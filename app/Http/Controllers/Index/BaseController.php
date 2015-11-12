<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\ArticleFunc;   //张池增加

use GirdPlugins\Base\mailFunc;
class BaseController extends Controller {
    public function index()  
    {
        $inputData['articleData'] = DB::table("base_article")->get();
        $inputData["displayArticleGui"] = $this->displayArticleClassBar(1);
        $inputData["newArticle"] = $this->newArticle();
        $inputData["indexRecommendArticle"] = $this->indexRecommendArticle();
        $inputData["displaySidebarClass"] = $this->sidebarClass();
        return view("Index.index",$inputData);
    }

    
    
    //从前端输入框获得一个名字为key的输入框，key 就是输入的文章名
   //用此文章名，要打印出关于此文章的所有信息的一个框
  //其中包括查看详情，点击则可以进入详情页面
    public function findArticle()  
    {
      // dump($_GET);
        if(isset($_GET["key"]))
        {
            $key = "%".$_GET["key"]."%";
            $results['articleData'] = DB::select('select * from base_article where article_title like :key', ['key' => $key]);
        }
        /*
        if(isset($_GET["class"]))
        {
            $results['articleData'] = DB::table("base_display_article_recommend")
                    ->where("recommend_class","=",$_GET["class"])
                    ->leftJoin("base_article","article_id","=","recommend_article")
                    ->orderBy("article_id","desc")
                    ->simplePaginate(10);
        }
        */
        if($results  ==  NULL){return redirect()->back();}
        
       // $inputData['article'] = DB::table('base_article')-> where('article_title','=','') ->first();
       
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


        $inputData['userData']=DB::table('base_user')-> where('user_id','=', $user_id)
            ->leftJoin("base_image","image_id","=","user_image")
                ->leftJoin("base_user_relation","relation_focus","=","user_id")
                    ->first();//提取一条记录,获得用户昵称


        
        //获得当前用户的所有文章
        $inputData['articleData'] = DB::table('base_article')-> where('article_user','=', $user_id)->
                orderBy("article_id","desc")->get();
        //获取当前用户的专题
        $inputData["subjectData"] = DB::table("base_article_subject")-> where('subject_user','=', $user_id)->
                orderBy("subject_id","desc")->get();


        //dump($inputData);
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


    public function sDisplayArticleClass($class_id)
    {
        $viewData["classData"] = DB::table("base_display_class")->where("class_id","=",$class_id)->get();
        $viewData["articleData"] = DB::table("base_display_article_recommend")
            ->where("recommend_class","=",$class_id)
            ->leftJoin("base_article","article_id","=","recommend_article")
            ->orderBy("article_id","desc")
            ->simplePaginate(15);
       /* $viewData["subjectData"] = DB::table("base_display_subject_recommend")
            ->where("recommend_class","=",$class_id)
            ->leftJoin("base_article","article_id","=","recommend_article")
            ->get();*/


        $viewData["articleClassBar"] =$this->sidebarClass();
        $viewData["indexRecommendArticle"] = $this->indexRecommendArticle();
        return view("Index.sDisplayArticleClass", $viewData);
    }
    
    
    
    
    
    //用户侧栏组件
    private function userSider($user_id)
    {
        $viewData["userData"] =  DB::table('base_user')
                ->leftJoin("base_user_relation","relation_focus","=","user_id")
                  ->where("user_id","=",$user_id)
               ->leftJoin("base_image","image_id","=","user_image")
                  //->leftJoin("base_article","user_id","=","article_user")
                  ->first();
         return view("Index.User.userSider",$viewData);
    }
    
    //一个推荐文章类的板块

    private function displayArticleClassBar($class_id,$num = 5)
    {
        $viewData["classData"] = DB::table("base_display_class")->where("class_id","=",$class_id)->first();
        $viewData["articleData"] = DB::table("base_display_article_recommend")
                ->where("recommend_class","=",$class_id)
                ->leftJoin("base_article","article_id","=","recommend_article")
                ->skip(0)->take($num)
                //->orderBy("recommend_sort","desc")
                ->get();
        return view("Index.Gui.displayArticleClassBar",$viewData);
    }
    //一个推荐专题类的板块
    private function displaySubjectClassBar($class_id,$num = 5)
    {
        $viewData["classData"] = DB::table("base_display_class")->where("class_id","=",$class_id)->first();
        $viewData["subjectData"] = DB::table("base_display_subject_recommend")
                ->where("recommend_class","=",$class_id)
                ->leftJoin("base_subject","subject_id","=","recommend_subject")
                ->skip(0)->take($num)
                //->orderBy("recommend_sort","desc")
                ->get();
        return view("Index.Gui.displaySubjectClassBar",$viewData);
    }
    
    //最新文章板块
    private function newArticle($num = 5)
    {
        $viewData["articleData"] = DB::table("base_article")
                ->orderBy("article_id","desc")
                ->skip(0)->take($num)
                ->get();
        return view("Index.Gui.newArticle",$viewData);
    }
    
    //首页推荐栏
    private function indexRecommendArticle($num = 5)
    {
        $viewData["indexData"] = DB::table("base_index_display")
                ->leftJoin("base_article","article_id","=","display_article_id")
                ->orderBy("display_sort","desc")->skip(0)->take($num)->get();
        return view("Index.Gui.indexRecommendArticle",$viewData);
    }
    
    
    //侧栏类别组件  需要一个单独的按类查找的页面
    private function sidebarClass()
    {
        $viewData["classData"] = DB::table("base_display_class")
               ->orderBy("class_sort","desc")->get();
        return view("Index.Gui.sidebarClass",$viewData);
    }
    
    

}
