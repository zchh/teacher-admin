<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\LogFunc;
use GirdPlugins\Base\AdminPowerFunc;

class DisplayController extends Controller {

    
    public function __construct(BaseFunc $baseFunc, AdminPowerFunc $powerFunc,LogFunc $logFunc)
    {
        $this->baseFunc = $baseFunc;
        $this->powerFunc = $powerFunc;
        $this->logFunc = $logFunc;
        if(!$powerFunc->checkAdminPower(13))
       {
            $this->baseFunc->setRedirectMessage(false, "你没有权限", NULL);
            return redirect()->back();
            
       }
        
    }
    
    
    public function displayIndex()
    {
        return view("Admin.Display.index");
        
    }
    
    
    //查看所有的推荐文章
    public function sRecommendArticle()
    {
        
        session(["now_address" => "/admin_sRecommendArticle"]);
        if(Request::input("search_article") != NULL)
        {
            $inputData["recommendData"] = DB::table("base_display_article_recommend")
                ->leftJoin("base_article","article_id","=","recommend_article")
                ->leftJoin("base_user","article_user","=","user_id")
                ->leftJoin("base_display_re_article","relation_recommend","=","recommend_id")
                ->leftJoin("base_display_article_class","relation_class","=","class_id")
                    ->orderBy(Request::input("sort_id","recommend_id"),"desc")
                    ->where("article_title","like","%".$_GET["search_article"]."%")
                ->simplePaginate(10);
        }
        else
        { 
        $inputData["recommendData"] = DB::table("base_display_article_recommend")
                ->leftJoin("base_article","article_id","=","recommend_article")
                ->leftJoin("base_user","article_user","=","user_id")
                ->leftJoin("base_display_re_article","relation_recommend","=","recommend_id")
                ->leftJoin("base_display_article_class","relation_class","=","class_id")
                ->orderBy(Request::input("sort_id","recommend_id"),"desc")
                ->simplePaginate(10);
        
        }
        
        $inputData["class_data"] = DB::table("base_display_article_class")->get();
        //dump($inputData);
        return view("Admin.Display.sRecommendArticle",$inputData);
    }
    
    
    //删除一个推荐文章
    public function dRecommendArticle($recommend_id,BaseFunc $baseFunc, AdminPowerFunc $powerFunc )
    {
       DB::beginTransaction();
        //dump($recommend_id);
        if(0!==DB::table("base_display_article_recommend")
                ->where("recommend_id","=",$recommend_id)->delete())
        {
             
           $this->logFunc->addLog(
                ["log_level"=>0,
                "log_title"=>"删除了一个文章关注,关注id=".$recommend_id,
                "log_detail"=>"删除了一个文章关注，关注id=".$recommend_id,
                "log_admin"=>session("admin.admin_id")]);
            DB::commit();
            $baseFunc->setRedirectMessage(true, "该文章已被移出出推荐", NULL);
            return redirect()->back();
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "无法删除该文章的推荐", NULL);
            return redirect()->back();
        }
    }
    
    //添加一个推荐文章
    public function aRecommendArticle(BaseFunc $baseFunc)
    {
       
        $inputData = Request::only("recommend_class","article_id","recommend_name");
        
        $recommendsData["recommend_article"] = $inputData["article_id"];
        $recommendsData["recommend_name"] = $inputData["recommend_name"];
        $recommendsData["recommend_create_date"] = date('Y-m-d H:i:s');
        
        DB::beginTransaction();
        
        $id = DB::table("base_display_article_recommend")->insertGetId($recommendsData);
        DB::table("base_display_re_article")->insert(["relation_class" =>  $inputData["recommend_class"], 
            "relation_recommend"=>$id]);
        $this->logFunc->addLog(
                ["log_level"=>0,
                "log_title"=>"添加了一个文章推荐,id=".$inputData["article_id"],
                "log_detail"=>"添加了一个文章推荐，id=".$inputData["article_id"],
                "log_admin"=>session("admin.admin_id")]);
        
        DB::commit();
        $baseFunc->setRedirectMessage(true, "推荐该文章成功", NULL);
        return redirect()->back();
    
    }
    
    
    //前台推荐文章分类
    public function sDisplayArticleClass()
    {
        session(["now_address" => "/admin_sDisplayArticleClass"]);
        return view("Admin.Display.sDisplayArticleClass");
    }
    
    //添加前台推荐文章分类
    public function aDisplayArticleClass()
    {
        $inputData = Request::only("class_name");
        DB::beginTransaction();
        if(1==DB::table("base_display_article_class")->insert($inputData))
        {
             $this->logFunc->addLog(
                ["log_level"=>0,
                "log_title"=>"添加了一个推荐文章分类,class_name=".$inputData["class_name"],
                "log_detail"=>"添加了一个推荐文章分类，class_name=".$inputData["class_name"],
                "log_admin"=>session("admin.admin_id")]);
             DB::commit();
            $this->baseFunc->setRedirectMessage(true, "添加推荐文章分类成功", NULL);
            return redirect()->back();
        }
        else
        {
            $this->baseFunc->setRedirectMessage(false, "添加推荐文章分类失败", NULL);
            return redirect()->back();
        }
        
        //dump($_POST);
    }
    //更新前台推荐文章分类
    public function uDisplayArticleClass()
    {
        $inputData = Request::only("class_name");
        $class_id = Request::input("class_id");
        DB::beginTransaction();
        if(1==DB::table("base_display_article_class")->where("class_id","=",$class_id)->update($inputData))
        {
             $this->logFunc->addLog(
                ["log_level"=>0,
                "log_title"=>"更改了一个推荐文章分类,class_name=".$inputData["class_name"],
                "log_detail"=>"更改了一个推荐文章分类，class_name=".$inputData["class_name"],
                "log_admin"=>session("admin.admin_id")]);
             DB::commit();
            $this->baseFunc->setRedirectMessage(true, "修改推荐文章分类成功", NULL);
            return redirect()->back();
        }
        else
        {
            $this->baseFunc->setRedirectMessage(false, "修改推荐文章分类失败", NULL);
            return redirect()->back();
        }
    }
    //删除前台推荐文章分类
    public function dDisplayArticleClass($class_id)
    {
        
        DB::beginTransaction();
        if(1==DB::table("base_display_article_class")->where("class_id","=",$class_id)->delete())
        {
             $this->logFunc->addLog(
                ["log_level"=>0,
                "log_title"=>"删除了一个推荐文章分类,class_id=".$class_id,
                "log_detail"=>"删除了一个推荐文章分类，class_id=".$class_id,
                "log_admin"=>session("admin.admin_id")]);
             DB::commit();
            $this->baseFunc->setRedirectMessage(true, "删除推荐文章分类成功", NULL);
            return redirect()->back();
        }
        else
        {
            $this->baseFunc->setRedirectMessage(false, "删除推荐文章分类失败", NULL);
            return redirect()->back();
        }
    }
    
    
    //查看所有的推荐专题
    
    
}