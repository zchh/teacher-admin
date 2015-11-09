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
            $this->baseFunc->setRedirectMessage(false, "你没有权限", NULL,"/admin_index");
            //return redirect("/admin_index");//在这里不能使用跳转
            
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
                ->leftJoin("base_display_class","recommend_class","=","class_id")
                ->leftJoin("base_index_display","display_article_id","=","article_id")
                ->orderBy(Request::input("sort_id","recommend_id"),"desc")
                    ->where("article_title","like","%".$_GET["search_article"]."%")
                ->simplePaginate(10);
        }
        else
        { 
        $inputData["recommendData"] = DB::table("base_display_article_recommend")
                ->leftJoin("base_article","article_id","=","recommend_article")
                ->leftJoin("base_user","article_user","=","user_id")
                ->leftJoin("base_display_class","recommend_class","=","class_id")
                ->leftJoin("base_index_display","display_article_id","=","article_id")
                ->orderBy(Request::input("sort_id","recommend_id"),"desc")
                ->simplePaginate(10);
        
        }
        
        $inputData["class_data"] = DB::table("base_display_class")->get();
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
        
        $inputData = Request::only("recommend_class","article_id");
        
        $recommendsData["recommend_article"] = $inputData["article_id"];
        $recommendsData["recommend_class"] = $inputData["recommend_class"];
        $recommendsData["recommend_create_date"] = date('Y-m-d H:i:s');
        
        DB::beginTransaction();
        
        $id = DB::table("base_display_article_recommend")->insertGetId($recommendsData);
       
        $this->logFunc->addLog(
                ["log_level"=>0,
                "log_title"=>"添加了一个文章推荐,id=".$inputData["article_id"],
                "log_detail"=>"添加了一个文章推荐，id=".$inputData["article_id"],
                "log_admin"=>session("admin.admin_id")]);
        
        DB::commit();
        $baseFunc->setRedirectMessage(true, "推荐该文章成功", NULL);
        return redirect()->back();
    
    }
  
    
    //查看所有的推荐专题
    public function  sRecommendSubject()
    {
        session(["now_address" => "/admin_sRecommendSubject"]);
        
        $sort = Request::input("sort",NULL);
        if($sort  ==NULL )
        {
            $sort = "recommend_id";
        }
        
        $search = Request::input("search_subject",NULL);
        if($search != NULL)
        {
            $recommendData["recommendData"] = DB::table("base_display_subject_recommend")
                ->leftJoin("base_article_subject","subject_id","=","recommend_subject")
                ->leftJoin("base_user","user_id","=","subject_user")
                ->leftJoin("base_display_class","recommend_class","=","class_id")
                ->where("subject_name","like","%".$search ."%")
                ->orderBy($sort,"desc")
                ->simplePaginate(10);
        }
        else
        {
            $recommendData["recommendData"] = DB::table("base_display_subject_recommend")
                ->leftJoin("base_article_subject","subject_id","=","recommend_subject")
                ->leftJoin("base_user","user_id","=","subject_user")
                ->leftJoin("base_display_class","recommend_class","=","class_id") 
                ->orderBy($sort,"desc")
                ->simplePaginate(10);
        }
        
        //dump($recommendData);
        $recommendData["class_data"] = DB::table("base_display_class")->get();
        
       // dump($recommendData["class_data"]);
        return view("Admin.Display.sRecommendSubject",$recommendData);
        
        
    }
    
    //更新推荐文章
    public function uRecommendArticle()
    {
        $inputData = Request::only("recommend_class");
        $relation_id = Request::input("recommend_id");
        DB::beginTransaction();
        if(1==DB::table("base_display_article_recommend")->where("recommend_id","=",$relation_id)->update($inputData))
        {
             $this->logFunc->addLog(
                ["log_level"=>0,
                "log_title"=>"更改了一个推荐文章信息,recommend_id=".$relation_id,
                "log_detail"=>"更改了一个推荐文章信息，recommend_id=".$relation_id,
                "log_admin"=>session("admin.admin_id")]);
             DB::commit();
            $this->baseFunc->setRedirectMessage(true, "修改推荐文章成功", NULL);
            return redirect()->back();
        }
        else
        {
            $this->baseFunc->setRedirectMessage(false, "修改推荐文章失败", NULL);
            return redirect()->back();
        }
    }
    
    
    
    
    //添加专题
    public function aRecommendSubject()
    {
       $inputData =  Request::only("recommend_subject","recommend_class");
       $inputData["recommend_create_date"] = date('Y-m-d H:i:s');  
       $inputData["recommend_update_date"] = date('Y-m-d H:i:s');
       if(DB::table("base_display_subject_recommend")->insert($inputData))
       {
            $this->logFunc->addLog(
                ["log_level"=>0,
                "log_title"=>"添加了一个推荐专题subject_id=".$inputData["recommend_subject"],
                "log_detail"=>"添加了一个推荐专题subject_id=".$inputData["recommend_subject"],
                "log_admin"=>session("admin.admin_id")]);
            $this->baseFunc->setRedirectMessage(true, "添加推荐专题成功", NULL);
            return redirect()->back();
       }
       else
       {
           
            $this->baseFunc->setRedirectMessage(false, "无法推荐专题", NULL);
            return redirect()->back();
       }
      
    }
    
    //更改专题
     public function uRecommendSubject()
    {
        $inputData = Request::only("recommend_class");
        $relation_id = Request::input("recommend_id");
        DB::beginTransaction();
        if(1==DB::table("base_display_subject_recommend")->where("recommend_id","=",$relation_id)->update($inputData))
        {
             $this->logFunc->addLog(
                ["log_level"=>0,
                "log_title"=>"更改了一个推荐专题信息,recommend_id=".$relation_id,
                "log_detail"=>"更改了一个推荐专题信息，recommend_id=".$relation_id,
                "log_admin"=>session("admin.admin_id")]);
             DB::commit();
            $this->baseFunc->setRedirectMessage(true, "修改推荐专题成功", NULL);
            return redirect()->back();
        }
        else
        {
            $this->baseFunc->setRedirectMessage(false, "修改推荐专题失败", NULL);
            return redirect()->back();
        }
    }
    
    
    //删除专题
    public function dRecommendSubject($re_id)
    {
         DB::beginTransaction();
        if(1==DB::table("base_display_subject_recommend")->where("recommend_id","=",$re_id)->delete())
        {
             $this->logFunc->addLog(
                ["log_level"=>0,
                "log_title"=>"删除了一个推荐专题,subject_id=".$re_id,
                "log_detail"=>"删除了一个推荐专题，subject_id=".$re_id,
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
    
    
    /////////////////展示类
    
    //添加展示主题类
    public function aDisplayClass()
    {
        $inputData = Request::only("class_name");
        DB::beginTransaction();
        if(1==DB::table("base_display_class")->insert($inputData))
        {
             $this->logFunc->addLog(
                ["log_level"=>0,
                "log_title"=>"添加推荐专题分类,class_name=".$inputData["class_name"],
                "log_detail"=>"添加推荐专题分类，class_name=".$inputData["class_name"],
                "log_admin"=>session("admin.admin_id")]);
             DB::commit();
            $this->baseFunc->setRedirectMessage(true, "添加推荐专题分类成功", NULL);
            return redirect()->back();
        }
        else
        {
            $this->baseFunc->setRedirectMessage(false, "添加推荐专题分类失败", NULL);
            return redirect()->back();
        }
    }
    
    //更新展示主题类
    public function dDisplayClass($class_id)
    {
        
        DB::beginTransaction();
        if(1==DB::table("base_display_class")->where("class_id","=",$class_id)->delete())
        {
             $this->logFunc->addLog(
                ["log_level"=>0,
                "log_title"=>"删除了一个推荐专题分类,class_id=".$class_id,
                "log_detail"=>"删除了一个推荐专题分类，class_id=".$class_id,
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
    
    
    //更新展示主题类
    public function uDisplayClass()
    {
        $inputData = Request::only("class_name");
        $class_id = Request::input("class_id");
        DB::beginTransaction();
        if(1==DB::table("base_display_class")->where("class_id","=",$class_id)->update($inputData))
        {
             $this->logFunc->addLog(
                ["log_level"=>0,
                "log_title"=>"更改了一个推荐专题分类,class_name=".$inputData["class_name"],
                "log_detail"=>"更改了一个推荐专题分类，class_name=".$inputData["class_name"],
                "log_admin"=>session("admin.admin_id")]);
             DB::commit();
            $this->baseFunc->setRedirectMessage(true, "修改推荐专题分类成功", NULL);
            return redirect()->back();
        }
        else
        {
            $this->baseFunc->setRedirectMessage(false, "修改推荐专题分类失败", NULL);
            return redirect()->back();
        }
    }
    
    
    
    //首页展示添加
    public function aDisplayIndex()
    {
        $displayData = Request::only("display_article_id","display_location");
        //dump($displayData); exit();
        DB::beginTransaction();
       
        if($id = DB::table("base_index_display")->insertGetId($displayData))
        {
           
             $this->logFunc->addLog(
                ["log_level"=>0,
                "log_title"=>"添加了一个展示,display_id=".$id,
                "log_detail"=>"display_id = $id ,display_article=".$displayData["display_article_id"]." , "
                    . "display_location = ".$displayData["display_location"],
                "log_admin"=>session("admin.admin_id")]);
             DB::commit();
            $this->baseFunc->setRedirectMessage(true, "添加展示成功", NULL);
            return redirect()->back();
        }
        else
        {
            $this->baseFunc->setRedirectMessage(false, "添加展示失败", NULL);
            return redirect()->back();
        }
    }
    
    //首页展示查看
    public function sDisplayIndex()
    {
       session(["now_address" => "/admin_sDisplayIndex"]);
       $viewData["indexData"] = DB::table("base_index_display")
               ->leftJoin("base_article","article_id","=","display_article_id")
               ->leftJoin("base_user","user_id","=","article_user")
               ->orderBy("display_id","desc")
               ->get();
       
       
       return view("Admin.Display.sDisplayIndex",$viewData); 
    }
    
    
    //首页展示页删除
    public function dDisplayIndex($display_id)
    {
       DB::beginTransaction();
        if(DB::table("base_index_display")->where("display_id","=",$display_id)->delete())
        {
           
             $this->logFunc->addLog(
                ["log_level"=>0,
                "log_title"=>"移出了一个展示,display_id=$display_id",
                "log_detail"=>"display_id=$display_id",
                "log_admin"=>session("admin.admin_id")]);
             DB::commit();
            $this->baseFunc->setRedirectMessage(true, "删除展示成功", NULL);
            return redirect()->back();
        }
        else
        {
            $this->baseFunc->setRedirectMessage(false, "删除展示失败", NULL);
            return redirect()->back();
        }
    }
    
    //首页展示页修改
    public function uDisplayIndex()
    {
        $inputData = Request::only("display_location");
        $displayId = Request::input("display_id");
        
        
        DB::beginTransaction();
        if(DB::table("base_index_display")->where("display_id","=",$displayId)->update($inputData))
        {
           
             $this->logFunc->addLog(
                ["log_level"=>0,
                "log_title"=>"更改了一个展示,display_id=$displayId",
                "log_detail"=>"display_id=$displayId",
                "log_admin"=>session("admin.admin_id")]);
             DB::commit();
            $this->baseFunc->setRedirectMessage(true, "修改展示成功", NULL);
            return redirect()->back();
        }
        else
        {
            $this->baseFunc->setRedirectMessage(false, "修改展示失败", NULL);
            return redirect()->back();
        }
        
    }
    
    
}