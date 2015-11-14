<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\LogFunc;
use GirdPlugins\Base\AdminPowerFunc;
class ArticleController extends Controller {
  
    
   
    //文章部分
    //查看所有文章
    public function sArticle()
    {
        session(["now_address" => "/admin_sArticle"]);

        //获取传来的class和sort并传入视图，方便生成分类和排序的链接
        $sort = Request::input("sort","article_id");
        $key = Request::input("key",NULL) ;
        $input_data["key"] = $key;
        $input_data["sort"] = $sort;
        $pageLimit = 5;
        

        $input_data['article_data'] = DB::table("base_article")
                ->leftJoin("base_article_re_subject","article_id","=","relation_article")
                ->leftJoin("base_article_subject","relation_subject","=","subject_id")
                ->leftJoin("base_display_article_recommend","recommend_article","=","article_id")
                ->where("article_title","like","%".$key."%")
                ->orderBy($sort,"desc")
                ->paginate($pageLimit);
        $input_data["pageGui"]= $input_data["article_data"]->appends(['sort' =>$sort,"key"=>$key])
                     ->render();  //分页数据
        //dump($input_data);exit();
        $input_data['now_page'] = $input_data['article_data']->currentPage();//得到当前页
        $input_data['all_page'] = (int)($input_data['article_data']->total()/$pageLimit)+1;//得到一共有多少页
        
        $input_data['subject_data']=DB::table("base_article_subject")->get();
        $input_data['label_data']=DB::table("base_article_label")->get();
        $input_data['class_data']=DB::table("base_article_class")->get();
        $input_data["recommend_class"] = DB::table("base_display_class")->get();
        return view("Admin.Article.articlelist",$input_data);
    }
    
    
    //添加文章(这个函数是添加文章到当前专题)
    public function AddArticleToSubject2(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base)
    {
        //检查该用户是否有权限添加文章到专题（写权限）
        $powerId=6;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！",  null, null);
            return redirect()->back();
        }
        $input_data = Request::only("subject_id","article_id_array");
        //dump($input_data);exit();
        foreach ($input_data['article_id_array'] as $article_id) 
        //for($i=0;$i<count($input_data['article_id_array']);$i++)
        {
            //dump($article_id);
            if(DB::table("base_article_re_subject")->where("relation_article","=",$article_id)
                ->get())//判断文章是否已有专题
                {
                    DB::beginTransaction();
                    if(DB::table("base_article_re_subject")->where("relation_article","=",$article_id)
                        ->update(["relation_subject"=>$input_data['subject_id']])
                        )
                    {
                        //在添加文章到专题之后添加此记录
                        $log_array["log_level"]=3;
                        $log_array["log_title"]="更新操作";
                        $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."更新了一篇文章到专题（并入专题）";
                        $log_array["log_data"]="更新";
                        $log_array["log_admin"]=session("admin.admin_id");
                        $logFunc->addLog($log_array);
                        DB::commit();
                    }
                    else
                    {
                        //并入专题失败，提示跳转
                        $base->setRedirectMessage(false, "操作失败", null, null);
                        return redirect()->back();
                    }
                }
                else
                {
                    //没有专题，就添加专题
                    DB::beginTransaction();
                    if(DB::table("base_article_re_subject")->insert(["relation_subject"=>$input_data['subject_id'], "relation_article"=>$article_id]))
                    {
                        //在添加文章到专题之后添加此记录
                        $log_array["log_level"]=3;
                        $log_array["log_title"]="添加操作";
                        $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."向专题添加了文章";
                        $log_array["log_data"]="添加";
                        $log_array["log_admin"]=session("admin.admin_id");
                        $logFunc->addLog($log_array);
                        DB::commit();
                    }
                    else
                    {
                        //失败
                        $base->setRedirectMessage(false, "并入专题失败",  null, null);
                        return redirect()->back();
                    }
                }
        }
        //并入专题成功，提示跳转
        $base->setRedirectMessage(true, "并入专题成功", null, null);
        return redirect()->back();
    }
    //接收表单把文章并入到一个专题
    public function AddArticleToSubject(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base)
    {
        //检查该管理员是否有权限添加文章到专题（写权限）
        //dump(session("admin"));exit();
        $powerId=6;
        if($adminPowerFunc->checkAdminPower($powerId) == false);
        {
            return $base->setRedirectMessage(false, "你没有权限进行此操作！",  null, "/admin_sArticle");
            //return redirect()->back();
        }
        $input_data = Request::only("article","subject");
        $insert_data['relation_article'] = $input_data['article'];
        $insert_data['relation_subject'] = $input_data['subject'];
        if(DB::table("base_article_re_subject")->where("relation_article","=",$input_data['article'])
                ->get())//判断文章是否已有专题
        {
            DB::beginTransaction();
            if(DB::table("base_article_re_subject")->where("relation_article","=",$input_data['article'])
                ->update(["relation_subject"=>$input_data['subject']])
                )
            {
                //并入专题成功，提示跳转
                //$data = $base->responseAjax("并入专题成功", "并入专题成功", "<a href='/admin_sArticle' class='btn btn-default'>点击返回</a>");
                //return $data;
                //在更新文章到专题之后添加此记录
                $log_array["log_level"]=0;
                $log_array["log_title"]="更新操作";
                $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."更新了文章的专题";
                $log_array["log_data"]="更新";
                $log_array["log_admin"]=session("admin.admin_id");
                $logFunc->addLog($log_array);
                DB::commit();
                $base->setRedirectMessage(true, "并入专题成功", "返回", "/admin_sArticle");
            }
            else
            {
                //并入专题失败，提示跳转
                //$data = $base->responseAjax("操作失败", "操作失败", "<a href='/admin_sArticle' class='btn btn-default'>点击返回</a>");
                //return $data;
                $base->setRedirectMessage(false, "操作失败", "返回", "/admin_sArticle");
            }
        }
        else
        {
            //没有专题，就添加专题
            DB::beginTransaction();
            if(DB::table("base_article_re_subject")->insert($insert_data))
            {
                //成功
                $base->setRedirectMessage(true, "并入专题成功", null, null);
                //在添加文章到专题之后添加此记录
                $log_array["log_level"]=0;
                $log_array["log_title"]="添加操作";
                $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."向专题添加了文章";
                $log_array["log_data"]="添加";
                $log_array["log_admin"]=session("admin.admin_id");
                $logFunc->addLog($log_array);
                DB::commit();
                return redirect()->back();
            }
            else
            {
                //失败
                $base->setRedirectMessage(false, "并入专题失败",  null, null);
                return redirect()->back();
            }
        }
        
        //dump($input_data);
    }
    //删除文章
    public function dArticle(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base,$article_id)
    {
        //dump($article_id);exit();
        $powerId=6;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作!",  null, "/admin_sArticle");
            //return redirect()->back();
        }
        DB::beginTransaction();
        if(DB::table("base_article")->where("article_id","=",$article_id)->delete())
        {
            //在删除文章之后添加此记录
            $log_array["log_level"]=2;
            $log_array["log_title"]="删除操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."删除了一篇文章";
            $log_array["log_data"]="删除";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            //删除成功
            $data = $base->setRedirectMessage(true, "删除成功", "返回", "/admin_sArticle");
            return $data;
        }
        else
        {
            //删除失败
            $data = $base->setRedirectMessage(false, "删除失败", "返回", "/admin_sArticle");
            return $data;
        }
        
    }
    /**
     * 
     * 专题部分
     * 
     * 
     */

    //查看所有专题
    public function sSubject()
    {
        session(["now_address" => "/admin_sSubject"]);
        //查找文章专题并分页显示
        $input_data['subject_data'] = DB::table('base_article_subject')
                ->leftJoin("base_display_subject_recommend","recommend_subject","=","subject_id")
                ->get();  //dump($input_data);
        $input_data["recommend_class"] = DB::table("base_display_class")->get();
        return view("Admin.Article.subjectlist",$input_data);
    }
    //(进行更新)
    public function uSubject(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base)
    {
        $powerId=7;
        if($adminPowerFunc->checkAdminPower($powerId))
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        $sunject_update_data = Request::only("subject_id","subject_name","subject_intro");
        $sunject_update_data['subject_update_date']=  date("Y-m-d H:i:s");
        DB::beginTransaction();
        if(DB::table("base_article_subject")->
                where("subject_id","=",$sunject_update_data["subject_id"])
                ->update($sunject_update_data))
        {
            //修改成功，提示跳转
            $base->setRedirectMessage(true, "并入专题成功", null, null);
            //在修改专题之后添加此记录
            $log_array["log_level"]=0;
            $log_array["log_title"]="更新操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."更新了一个专题";
            $log_array["log_data"]="更新";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            return redirect()->back();
        }
        else
        {
            //修改失败，提示跳转
            $base->setRedirectMessage(false, "并入专题失败", null, null);
            return redirect()->back();
        }
        
        //dump($sunject_update_data);
    }
    //根据$subject_id删除指定专题
    public function dSubject(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base,$subject_id)
    {
        $powerId=7;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        //删除base_article_subject表的指定专题
        DB::beginTransaction();
        if(DB::table("base_article_subject")->where("subject_id","=","$subject_id")->delete())
        {
            //return  response()->json(['status'=>'true','message'=>'删除成功']);
            $base->setRedirectMessage(true, "删除专题成功", null, null);
            //在删除专题之后添加此记录
            $log_array["log_level"]=2;
            $log_array["log_title"]="删除操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."删除了一个专题";
            $log_array["log_data"]="删除";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            return redirect()->back();
            //删除成功后再删除base_article_re_subject
        }
        else
        {
            $base->setRedirectMessage(false, "添加专题失败", null, null);
            return redirect()->back();
            //return  response()->json(['status'=>'false','message'=>'删除失败']);
        }
        
    }
    //添加专题
    /*public function aSubject(BaseFunc $base)
    {
        $input_data['ajax_request'] = $base->requestAjax(["subject_id","sunject_name","subject_create_date","subject_update_date","subject_intro"], "subject", "/_admin_aSubject",true);
        return view("Admin.Article.asubject",$input_data);
    }*/
    //返回的ajax数据(进行添加)
    public function aSubject(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base)
    {
        $powerId=7;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        $subject_add_data = Request::only("subject_name","subject_intro"); 
        $subject_add_data['subject_create_date']=date("Y-m-d H:i:s");
        DB::beginTransaction();
        if(DB::table("base_article_subject")->insert($subject_add_data))
        { 
            //添加成功，提示跳转
            $base->setRedirectMessage(true, "添加专题成功", null, null);
            //在添加专题之后添加此记录
            $log_array["log_level"]=2;
            $log_array["log_title"]="添加操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."添加了一个专题";
            $log_array["log_data"]="添加";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            return redirect()->back();
        }
        else
        {
            //添加失败，提示跳转
            $base->setRedirectMessage(false, "添加专题失败", null, null);
            return redirect()->back();
        }
        
        //dump($subject_add_data);
    }
    //专题详情
    public function moreSubject($subject_id)
    {
        //获取所有的文章
        $input_data['all_article_data'] = DB::table("base_article")->get();
        $input_data['subject_by_id'] = DB::table("base_article_subject")->where("subject_id","=",$subject_id)->first();
        //dump($input_data);exit();
        //获取当前专题下的所有文章信息
        $article_by_subject = DB::table("base_article_subject")->leftJoin("base_article_re_subject","subject_id","=","relation_subject")->
                leftJoin("base_article","relation_article","=","article_id")->where("subject_id","=",$subject_id)->get();
        $article_ids = array();
        foreach ($article_by_subject as $value) 
        {
           $article_ids[]=$value->article_id;
        }
        $input_data['article_ids']=$article_ids;
        //dump($article_ids);exit();
        $input_data['article_by_subject']=$article_by_subject;
        return view("Admin.Article.moresubject",$input_data);
    }
    
    //从专题移除一篇文章
    public function RemoveArticleToSubject(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base,$subject_id,$article_id)
    {
        $powerId=7;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        DB::beginTransaction();
        if(DB::table("base_article_re_subject")
                ->where("relation_subject","=",$subject_id)
                ->where("relation_article","=",$article_id)
                ->update(["relation_subject"=>null]))
        {
            //移除成功，提示跳转
            //在专题内移除文章之后添加此记录
            $log_array["log_level"]=2;
            $log_array["log_title"]="移除操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."从一个专题提出了一篇文章";
            $log_array["log_data"]="移除";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            $data=$base->setRedirectMessage(true, "移除成功", "返回", "/admin_moreSubject/".$subject_id."");
            //$data = $base->responseAjax("移除成功", "移除成功", "<a href='/admin_moreSubject/".$subject_id."' class='btn btn-default'>点击返回</a>");
            return $data;
        }
        else
        {
            //移除失败，提示跳转
            $data=$base->setRedirectMessage(false, "移除失败", "返回", "/admin_moreSubject/".$subject_id."");
            //$data = $base->responseAjax("移除失败", "移除失败", "<a href='/admin_moreSubject/".$subject_id."' class='btn btn-default'>点击返回</a>");
            return $data;
        }
        
    }
    
    /*
     * 
     * 标签部分
     * 
     * 
     */
    //查看所有标签
    public function sLebel()
    {
        session(["now_address" => "/admin_sLebel"]);
        $input_data['label_data'] = DB::table("base_article_label")->paginate(3);
        //dump($label_data);
        return view("Admin.Article.slebel",$input_data);
    }
    /*public function uLebel($label_id)
    {
        //根据传过来的标签id查询记录显示原有的该标签数据
        $input_data['labelData_by_labelId'] = DB::table("base_article_label")
                ->where("label_id","=",$label_id)->get();
        return view("Admin.Article.ulabel",$input_data);
    }*/
    public function _uLebel(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base)
    {
        $powerId=8;
        if($adminPowerFunc->checkAdminPower($powerId)  == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        $input_data = Request::only("label_id","label_name","label_create_date","label_update_date");
        $input_data['label_update_date']= date("Y-m-d H:i:s");
        DB::beginTransaction();
        if(DB::table("base_article_label")->where("label_id","=",$input_data['label_id'])
                ->update($input_data)
                )
        {
            //修改成功，提示跳转
            $data = $base->setRedirectMessage(true, "标签修改成功",null,null);
            //在修改标签之后添加此记录
            $log_array["log_level"]=0;
            $log_array["log_title"]="修改操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."修改了一个标签";
            $log_array["log_data"]="修改";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            return redirect()->back();
        }
        else
        {
            //修改失败，提示跳转
           $data = $base->setRedirectMessage(false, "标签修改失败",null,null);
            return redirect()->back();
        }
        
    }
    public function dLebel(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base,$label_id)
    {
        $powerId=8;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        DB::beginTransaction();
        if(DB::table("base_article_label")->where("label_id","=",$label_id)->delete())
        {
            $data = $base->setRedirectMessage(true, "标签删除成功", "返回", "/admin_sLebel");
            //在删除标签之后添加此记录
            $log_array["log_level"]=0;
            $log_array["log_title"]="删除操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."删除了一个标签";
            $log_array["log_data"]="删除";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            return $data;
        }
        else
        {
            $data = $base->setRedirectMessage(false, "标签删除失败", "返回", "/admin_sLebel");
            return $data;
        }
        
    }
    //添加标签
    /*public function aLebel(BaseFunc $base)
    {
        $input_data['ajax_request'] = $base->requestAjax(["label_name","label_create_date"], "label", "/_admin_aLebel",true);
        return view("Admin.Article.alebel",$input_data);
    }*/
    public function aLebel(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base)
    {
        $powerId=8;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        $input_data = Request::only("label_name");
        if($input_data['label_name'] == "")
        {
            $data = $base->setRedirectMessage(false, "添加标签失败", "返回", "/admin_aLebel");
            return $data;
        }
        $input_data['label_create_date']=date("Y-m-d H:i:s");
        DB::beginTransaction();
        if(DB::table("base_article_label")->insert($input_data))
        {
            $data = $base->setRedirectMessage(true, "添加标签成功", "返回", "/admin_sLebel");
            //在添加标签之后添加此记录
            $log_array["log_level"]=0;
            $log_array["log_title"]="添加操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."添加了一个标签";
            $log_array["log_data"]="添加";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            return $data;
        }
        else
        {
            $data = $base->setRedirectMessage(false, "添加标签失败", "返回", "/admin_aLebel");
            return $data;
        }
        
    }
    public function aAticleLabel(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base)
    {
        $powerId=6;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            return $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, "/admin_sArticle");
            //return redirect()->back();
        }
        $input_data = Request::only("article_id","label_id");
        $insert_data['relation_article']=$input_data['article_id'];
        $insert_data['relation_label']=$input_data['label_id'];
        if(DB::table("base_article_re_label")->where("relation_article","=",$input_data['article_id'])
                ->where("relation_label","=",$input_data['label_id'])
                ->get())//判断文章是否已有标签
        {
            //此文章有了标签就执行修改
            DB::beginTransaction();
            if(DB::table("base_article_re_label")->where("relation_article","=",$input_data['article_id'])
                    ->update(["relation_label"=>$input_data['label_id']]))
            {
                //修改成功
                $data = $base->setRedirectMessage(true, "文章标签修改成功", "返回", "/admin_sArticle");
                //给文章修改标签之后添加此记录
                $log_array["log_level"]=0;
                $log_array["log_title"]="给文章修改标签";
                $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."给文章修改了一个标签";
                $log_array["log_data"]="给文章修改标签";
                $log_array["log_admin"]=session("admin.admin_id");
                $logFunc->addLog($log_array);
                DB::commit();
                return $data;
            }
            else
            {
                //修改失败
                $data = $base->setRedirectMessage(false, "文章标签修改失败", "返回", "/admin_sArticle");
                return $data;
            }
        }
        else
        {
            //没有标签，就添加标签
            DB::beginTransaction();
            if(DB::table("base_article_re_label")->insert($insert_data))
            {
                //成功
                $data = $base->setRedirectMessage(true, "添加标签失败", "返回", "/admin_sArticle");
                //给文章添加标签之后添加此记录
                $log_array["log_level"]=0;
                $log_array["log_title"]="给文章添加标签";
                $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."给文章添加了一个标签";
                $log_array["log_data"]="给文章添加标签";
                $log_array["log_admin"]=session("admin.admin_id");
                $logFunc->addLog($log_array);
                DB::commit();
                return $data;
            }
            else
            {
                //失败
                $data = $base->setRedirectMessage(false, "添加标签失败", "返回", "/admin_sArticle");
                return $data;
            }
        }
        
        //dump($_POST);
    }
    /*
     * 
     * 文章分类部分
     */
    //查看所有分类
    public function sClass()
    {
        session(["now_address"=>"/admin_sClass"]);
        $input_data['class_data'] = DB::table("base_article_class")->orderBy("class_create_date","desc")->paginate(3);
        //dump($input_data);
        return view("Admin.Article.sClass",$input_data);
    }
    //修改类别
    public function uClass(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base)
    {
        $powerId=12;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        $input_data = Request::only("class_id","class_name");
        $input_data["class_update_date"]=date("Y-m-d H:i:s");
        DB::beginTransaction();
        if(DB::table("base_article_class")->where("class_id","=",$input_data['class_id'])->update($input_data))
        {
            //成功
            $base->setRedirectMessage(true, "修改分类成功", null, null);
            //给修改类别之后添加此记录
            $log_array["log_level"]=0;
            $log_array["log_title"]="修改操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."修改了一个文章类别";
            $log_array["log_data"]="修改";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            return redirect()->back();
        }
        else
        {
            //失败
            $base->setRedirectMessage(false, "修改分类失败", null, null);
            return redirect()->back();
        }
        
    }
    //删除类别
    public function dClass(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base,$class_id)
    {
        $powerId=12;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        DB::beginTransaction();
        if(DB::table("base_article_class")->where("class_id","=",$class_id)->delete())
        {
            //成功
            $base->setRedirectMessage(true, "删除成功", null, null);
            //给文章添加标签之后添加此记录
            $log_array["log_level"]=0;
            $log_array["log_title"]="删除操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."删除了一个文章类别";
            $log_array["log_data"]="删除";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            return redirect()->back();
        }
        else
        {
            //失败
            $base->setRedirectMessage(false, "删除失败", null, null);
            return redirect()->back();
        }
        
    }
    //添加分类
    public function aClass(AdminPowerFunc $adminPowerFunc,LogFunc $logFunc,BaseFunc $base)
    {
        $powerId=12;
        if($adminPowerFunc->checkAdminPower($powerId) == false)
        {
            $base->setRedirectMessage(false, "你没有权限进行此操作！如果你想进行此操作，请联系超级管理员",  null, null);
            return redirect()->back();
        }
        $input_data = Request::only("class_name");
        $input_data["class_create_date"]=date("Y-m-d H:i:s");
        DB::beginTransaction();
        if(DB::table("base_article_class")->insert($input_data))
        {
            //成功
            $base->setRedirectMessage(true, "添加分类成功", null, null);
            //添加分类之后添加此记录
            $log_array["log_level"]=0;
            $log_array["log_title"]="添加操作";
            $log_array["log_detail"]=date("Y-m-d H:i:s").session("admin.nickname")."添加了一个文章类别";
            $log_array["log_data"]="添加";
            $log_array["log_admin"]=session("admin.admin_id");
            $logFunc->addLog($log_array);
            DB::commit();
            return redirect()->back();
        }
        else
        {
            //失败
            $base->setRedirectMessage(false, "添加分类失败", null, null);
            return redirect()->back();
        }
        
    }
}

