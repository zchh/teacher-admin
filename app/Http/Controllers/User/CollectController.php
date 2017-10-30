<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use BaseClass\Component\Article\ArticleCollect;
use BaseClass\Component\Article\ArticleCollectClass;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\LogFunc;
use GirdPlugins\Base\AdminPowerFunc;
class CollectController extends Controller {
    
    public function sCollect()
    {
        session(["nowPage"=>"/user_sCollect"]); 
        $data["collectData"]=DB::table('base_article_collect')
                ->leftJoin("base_article_collect_class","class_id","=","collect_class")
                ->leftJoin("base_user","user_id","=","collect_user")
                ->leftJoin("base_article","article_id","=","collect_article_id")
                ->get();
        $data["classData"]=DB::table('base_article_collect_class')->get();
        $data["class_data"]=DB::table("base_article_collect_class")->get();
        return view("User.Collect.sCollect",$data);
    }
    
    public function uCollect(BaseFunc $baseFunc)
    {
        $collectId = Request::input('collect_id');
        $collectClass['collect_class'] = Request::input("collect_class");
        $updateObj=new ArticleCollect($collectId);
        $updateObj->update($collectClass);
        $baseFunc->setRedirectMessage(true, "修改收藏文章成功！", null, null);
        return redirect()->back();
    }
    
    public function dCollect(BaseFunc $baseFunc,$collectId)
    {
       $removeCollect=new ArticleCollect($collectId);
        $removeCollect->remove();
        $baseFunc->setRedirectMessage(true, "移除收藏文章成功！", null, null);
        return redirect()->back();
    }
    
    public function aCollectClass(LogFunc $logFunc,BaseFunc $baseFunc)
    {      
        $input_data=Request::only("class_name");
        ArticleCollectClass::add($input_data);
        $baseFunc->setRedirectMessage(true, "添加收藏夹成功！", null, null);
        return redirect()->back();
    }
    
    public function uCollectClass(LogFunc $logFunc,BaseFunc $baseFunc)
    {

        $classId = Request::input('class_id');
        $className['class_name']= Request::input("class_name");
        $updateCollectClass= new ArticleCollectClass($classId);
        $updateCollectClass->update($className);
        $baseFunc->setRedirectMessage(true, "修改收藏夹成功！", null, null);
        return redirect()->back();
    }
    
    public function dCollectClass(LogFunc $logFunc,BaseFunc $baseFunc,$classId)
    {
        $deleteCollectClass=new ArticleCollectClass($classId);
        $deleteCollectClass->delete();
        $baseFunc->setRedirectMessage(true, "删除收藏夹成功！", null, null);
        return redirect()->back();
    }
    
    public function addArticleToCollect(LogFunc $logFunc,BaseFunc $baseFunc)
    {
        $input_data=Request::only("collect_class","collect_article_id");
        ArticleCollect::add($input_data);
        $baseFunc->setRedirectMessage(true, "收藏文章成功！", null, null);
        return redirect()->back();
    }
}