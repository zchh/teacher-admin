<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use BaseClass\Component\Article\ArticleReplyTree;
use Illuminate\Support\Facades\DB;
use GirdPlugins\Base\ArticleFunc;   //张池增加

class BaseController extends Controller {
    public function index()  
    {
        $inputData['articleData'] = DB::table("base_article")->get();
      
        $inputData["newArticle"] = $this->newArticle();
        $inputData["indexRecommendArticle"] = $this->indexRecommendArticle();
        $inputData["displaySidebarClass"] = $this->sidebarClass();
        
        /*分类文章概览*/
        /*$inputData["displayArticleClassGui1"] = $this->displayArticleClassBar(1);
        $inputData["displayArticleClassGui2"] = $this->displayArticleClassBar(2);
        $inputData["displayArticleClassGui3"] = $this->displayArticleClassBar(3);*/
        
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
                orderBy("article_id","desc")->simplePaginate(10);
        //获取当前用户的专题
        $inputData["subjectData"] = DB::table("base_article_subject")-> where('subject_user','=', $user_id)->
                orderBy("subject_id","desc")->simplePaginate(10);
        //获取图片
        $inputData["imageData"] = DB::table("base_image")->where("image_user","=",$user_id)->simplePaginate(9);

        return view("Index.User.userIndex",$inputData);
        
        
    }
    
    
   public function sSubject($class_id = 0)    //得到所有专题，并列出来
    {
       if($class_id == 0)
       {
           $inputData['subject']  = DB::table('base_display_subject_recommend')
                 ->join("base_display_class","recommend_class","=","class_id") 
                 ->orderBy("recommend_id","desc")
                 ->join("base_article_subject","subject_id","=","recommend_subject")
                 ->join("base_user","user_id","=","subject_user")
                 -> paginate(10);
           $inputData["class_name"] = "全部专题";
       }
       else 
       {
           $inputData['subject']  = DB::table('base_display_subject_recommend')
                 ->where("recommend_class","=",$class_id)
                 ->join("base_display_class","recommend_class","=","class_id") 
                 ->orderBy("recommend_id","desc")
                 ->join("base_article_subject","subject_id","=","recommend_subject")
                 ->join("base_user","user_id","=","subject_user")
                 -> paginate(10);
           
           $inputData["class_name"] = DB::table("base_display_class")->where("class_id","=",$class_id)->first()->class_name;
       }
         
         
         $inputData['siderGui'] = $this->sidebarClass("index_sSubject");
    
        return view("Index.Subject.sSubject",$inputData);
    }
    
   public function moreSubject($subject_id)     //传递满足$subject_id的文章
    {
           $inputData['articleData'] =  DB::table('base_article_re_subject')
                   ->leftJoin("base_article","article_id","=","relation_article")
                   ->where('relation_subject','=',$subject_id)
                   ->orderBy("relation_sort")->get();//提取包含文章多个id
          
           $inputData['subjectData'] =  DB::table('base_article_subject')
                   ->where("subject_id","=",$subject_id)
                   ->first();     
            
           $inputData["userInfoGui"] = $this->userSider($inputData["subjectData"]->subject_user);
       
           DB::table("base_article_subject")->where("subject_id","=",$subject_id)->increment('subject_click');
           return view("Index.Subject.moreSubject",$inputData);
        
    }
    
    public function articleDetail(ArticleFunc $articleFunc, $article_id)
    {
        $viewData["articleData"] = DB::table('base_article')
                  ->where("article_id","=",$article_id)
                  ->leftJoin("base_user","user_id","=","article_user")
                  ->first();
        $collectStatus = DB::table("base_article_collect")
                ->where("collect_user","=",session("user.user_id"))
                ->where("collect_article_id","=",$article_id)
                ->first();
        $collectStatus!=NULL?$viewData["collectStatus"]=true:$viewData["collectStatus"]=false;
        
        DB::table("base_article")->where("article_id","=",$article_id)->increment('article_click');
        $viewData["choseData"] =NULL;
        $viewData["classData"]=DB::table('base_article_collect_class')->get();
       // $viewData["replyData"] = $articleFunc->getArticleReply($article_id);//我就是评论树的调用！！！
        //zc
          $limit_tree["article_id"] = $article_id;
          $limit_tree["join_user"] = true;
          $limit_tree["join_relation"] = true;
          $tree = new ArticleReplyTree($limit_tree);
          $viewData["replyData"]  = $tree -> buildArticleReplyTree();


        //zc

        $viewData["userInfoGui"] = $this->userSider($viewData["articleData"]->article_user);
        $viewData["sidebarRecommendGui"] = $this->sidebarRecommendArticle();
        return view("Index.Article.articleDetail",$viewData);
       
    }

    /*按类别查看文章*/
    public function sDisplayArticleClass($class_id = 0)
    {
                
        $viewData["classData"] = DB::table("base_display_class")->get();
        if($class_id == 0)
        {
           $viewData["articleData"] = DB::table("base_display_article_recommend")
            ->leftJoin("base_article","article_id","=","recommend_article")
                ->join("base_user","user_id","=","article_user")
            ->orderBy("article_id","desc")
            ->simplePaginate(15);
           $viewData["nowClassName"] = "所有文章";
           $viewData["nowClassId"] = NULL;
            
        }
        else
        {
            $viewData["articleData"] = DB::table("base_display_article_recommend")
                ->where("recommend_class","=",$class_id)
                ->leftJoin("base_article","article_id","=","recommend_article")
                    ->join("base_user","user_id","=","article_user")
                ->orderBy("article_id","desc")
                ->simplePaginate(15);
                foreach($viewData["classData"] as $data)
                {
                    if($data->class_id == $class_id)
                    {
                        $viewData["nowClassName"] = $data->class_name;
                        $viewData["nowClassId"] = $data->class_id;
                        break;
                    }
                }
        }
     
       /* $viewData["subjectData"] = DB::table("base_display_subject_recommend")
            ->where("recommend_class","=",$class_id)
            ->leftJoin("base_article","article_id","=","recommend_article")
            ->get();*/


        $viewData["articleClassBar"] =$this->sidebarClass();
        $viewData["indexRecommendArticle"] = $this->sidebarRecommendArticle();
        return view("Index.sDisplayArticleClass", $viewData);
    }
    
    
    /*各种组件模块*/
    
    
    
    
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
    
    

    //显示类别的页面
    public function sClass()
    {
        //DB::table()->get();
    }
    
    //显示一个文章类的概览
    private function displayArticleClassBar($class_id,$num = 5)
    {
        $viewData["classData"] = DB::table("base_display_class")->where("class_id","=",$class_id)->first();
        $viewData["articleData"] = DB::table("base_display_article_recommend")
                ->where("recommend_class","=",$class_id)
                ->leftJoin("base_article","article_id","=","recommend_article")
                ->join("base_user","user_id","=","article_user")
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
                 ->join("base_user","user_id","=","article_user")
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
                 ->join("base_user","user_id","=","article_user")
                ->get();
        return view("Index.Gui.newArticle",$viewData);
    }
    
    //首页推荐栏
    private function indexRecommendArticle($num = 5)
    {
        $viewData["indexData"] = DB::table("base_index_display")
                ->where("display_location","=",0)
                ->leftJoin("base_article","article_id","=","display_article_id")
                  ->join("base_user","user_id","=","article_user")
                ->orderBy("display_sort","desc")->skip(0)->take($num)->get();
        return view("Index.Gui.indexRecommendArticle",$viewData);
    }
    //侧栏类别组件  需要一个单独的按类查找的页面
    private function sidebarClass($url = "index_sDisplayArticleClass")
    {
        $viewData["classData"] = DB::table("base_display_class")
               ->orderBy("class_sort","desc")->get();
        $viewData["url"] = $url;
        return view("Index.Gui.sidebarClass",$viewData);
    }
    //侧栏推荐文章
    private function sidebarRecommendArticle($num = 5)
    {
         $viewData["displayData"] = DB::table("base_index_display")
                 ->where("display_location","=",2)
               ->leftJoin("base_article","article_id","=","display_article_id")
                   ->join("base_user","user_id","=","article_user")
                ->orderBy("display_sort","desc")->skip(0)->take($num)->get();
        return view("Index.Gui.sidebarRecommendArticle",$viewData);
    }



}
