<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
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
    
    public function uCollect(LogFunc $logFunc,BaseFunc $baseFunc)
    {
        //dump($_POST);exit();
        $collectId = Request::input('collect_id');
        $collectClass = Request::input("collect_class");
        DB::table("base_article_collect")->where("collect_id", "=", $collectId)->update([
            "collect_class" => $collectClass
        ]);
        $baseFunc->setRedirectMessage(true, "修改收藏文章成功！", null, null);
        return redirect()->back();
    }
    
    public function dCollect(LogFunc $logFunc,BaseFunc $baseFunc,$collectId)
    {
        DB::table("base_article_collect")->where("collect_id","=",$collectId)->delete();
        $baseFunc->setRedirectMessage(true, "移除收藏文章成功！", null, null);
        return redirect()->back();
    }
    
    public function aCollectClass(LogFunc $logFunc,BaseFunc $baseFunc)
    {      
        $input_data=Request::only("class_name");     
        $input_data['class_create_date']=date("Y-m-d H:i:s");
        $input_data['class_user']=  session("user.user_id");
        DB::table("base_article_collect_class")->insert($input_data);
        $baseFunc->setRedirectMessage(true, "添加收藏夹成功！", null, null);
        return redirect()->back();
    }
    
    public function uCollectClass(LogFunc $logFunc,BaseFunc $baseFunc)
    {

        $classId = Request::input('class_id');
        $className = Request::input("class_name");
        DB::table("base_article_collect_class")->where("class_id", "=", $classId)->update([
            "class_name" => $className
        ]);
        $baseFunc->setRedirectMessage(true, "修改收藏夹成功！", null, null);
        return redirect()->back();
    }
    
    public function dCollectClass(LogFunc $logFunc,BaseFunc $baseFunc,$classId)
    {
        DB::table("base_article_collect_class")->where("class_id","=",$classId)->delete();
        $baseFunc->setRedirectMessage(true, "删除收藏夹成功！", null, null);
        return redirect()->back();
    }
    
    public function addArticleToCollect(LogFunc $logFunc,BaseFunc $baseFunc)
    {
        $input_data=Request::only("collect_class","collect_article_id");
        $input_data['collect_create_date']=date("Y-m-d H:i:s");
        $input_data['collect_update_date']=date("Y-m-d H:i:s");
        $input_data['collect_user']=  session("user.user_id");
        DB::table("base_article_collect")->insert($input_data);
        $baseFunc->setRedirectMessage(true, "收藏文章成功！", null, null);
        return redirect()->back();
    }
}