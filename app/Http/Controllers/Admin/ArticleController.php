<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class ArticleController extends Controller { 
    /*public function te(BaseFunc $base)
    {
       
       $input_data["ajax_request"] = $base->requestAjax(["admin_username","admin_password"], "123", "/_admin_te");
       return view("Admin.Article.te",$input_data);
       
    }
    public function _te(BaseFunc $base)
    {
        $data = $base->responseAjax("正确", "你通过了", "<a href='/admin_index' class='btn btn-default'>跳船</a>");
        return $data;
        
    }*/
    public function sArticle()
    {
        return view("Admin.Article.articlelist");
    }
    //查看所有专题
    public function sSubject()
    {
        //查找文章专题并分页显示
        $input_data['subject_data'] = DB::table('base_article_subject')->paginate(3);
        return view("Admin.Article.subjectlist",$input_data);
    }
    //修改专题信息
    public function uSubject(BaseFunc $base,$subject_id)
    {
        $input_data['ajax_request'] = $base->requestAjax(["subject_id","sunject_name","subject_create_date","subject_update_date","subject_intro"], "subject", "/_admin_uSubject",true);
        //根据subject_id获取此文章专题信息
        $input_data['subject_data'] = DB::table("base_article_subject")->where("subject_id","=","$subject_id")->get();
        //dump($input_data);
        return view("Admin.Article.usubject",$input_data);
    }
    //返回的ajax数据(进行更新)
    public function _uSubject(BaseFunc $base)
    {
        $sunject_update_data = Request::all();
        $res = DB::table("base_article_subject")->
                where("subject_id","=",$sunject_update_data["subject_id"])->
                where("subject_user","=",  session("username"))           //验证是否是当前用户操作专题  
                ->update($sunject_update_data);
        dump($sunject_update_data);
    }
    //根据$subject_id删除指定专题
    public function dSubject($subject_id)
    {
        //删除base_article_subject表的指定专题
        if(DB::table("base_article_subject")->where("subject_id","=","$subject_id")->delete())
        {
            //return  response()->json(['status'=>'true','message'=>'删除成功']);
            echo "<script>window.alert('删除成功');window.location.href('admin_sSubject');</script>";
            //删除成功后再删除base_article_re_subject
        }
        else
        {
            echo "<script>window.alert('删除失败');window.location.href('admin_sSubject');</script>";
            //return  response()->json(['status'=>'false','message'=>'删除失败']);
        }
    }
    //添加专题
    public function aSubject()
    {
        return view("Admin.Article.asubject");
    }
    public function _aSubject()
    {
        dump(Request::all());
    }
}
