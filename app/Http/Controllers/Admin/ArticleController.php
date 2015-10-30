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
    //文章部分
    //查看所有文章
    public function sArticle()
    {
        session(["now_address" => "/admin_sArticle"]);
        //查询所有的文章并分页显示
        $input_data['article_data'] = DB::table("base_article")
                ->leftJoin("base_article_re_subject","article_id","=","relation_article")
                ->leftJoin("base_article_subject","relation_subject","=","subject_id")
                ->paginate(3);
        //dump($input_data);
        $input_data['subject_data']=DB::table("base_article_subject")->get();
        $input_data['label_data']=DB::table("base_article_label")->get();
        return view("Admin.Article.articlelist",$input_data);
    }
    //根据条件选择文章
    public function sArticleByCondition()     
    { 
        $input_data=Request::only("condition","search");
        $res_data[]= "";
        if($input_data['condition'] == 'article_title')
        {
            $res_data['data_by_condition'] = DB::select("select * from base_article where ".$input_data['condition']." = '".$input_data['search']."'");
            //dump($data_by_condition);
            //$data_by_condition = DB::table("base_article")->where($input_data['condition'],"like",$input_data['search'])->get();
        }
        elseif ($input_data['condition'] == 'article_create_date') 
        {
            //获取当前日期
            $date_now= date("Y-m-d H:i:s");
            $res_data['data_by_condition'] = DB::select("select * from base_article where ".$input_data['condition']." between '".$input_data['search']."' and '".$date_now."'");
            //dump($data_by_condition);
            //$data_by_condition = DB::table("base_table")->whereBetween("$input_data['condition']",[$input_data['search'],$date_now])->get();
        }
        elseif($input_data['condition'] == 'class_name')
        {
            
            $res_data['data_by_condition'] = DB::table("base_article_class")->leftJoin("base_article","class_id","=","article_class")->where("class_name","=",$input_data['search'])->get();
        }
        //专题信息
        $res_data['subject_data']=DB::table("base_article_subject")->get();
        return view("Admin.Article.conditionlist",$res_data);
        //dump($data_by_condition);
    }
    //添加文章(这个函数是把添加文章时的选项数据显示出来)
    public function aArticle()
    {
        //把所有的文章类别查询出来显示在option中
        $input_data['article_class_data'] = DB::table("base_article_class")->get();
        //把所有的文章专题查询出来显示在option中
        $input_data['article_subject_data'] = DB::table("base_article_subject")->get();;
    }
    //接收表单把文章并入到一个专题
    public function AddArticleToSubject(BaseFunc $base)
    {
        $input_data = Request::only("article","subject");
        $insert_data['relation_article'] = $input_data['article'];
        $insert_data['relation_subject'] = $input_data['subject'];
        if(DB::table("base_article_re_subject")->where("relation_article","=",$input_data['article'])
                ->where("relation_subject","=",$input_data['subject'])
                ->get())//判断文章是否已有专题
        {
            if(DB::table("base_article_re_subject")->where("relation_article","=",$input_data['article'])
                ->update(["relation_subject"=>$input_data['subject']])
                )
            {
                //并入专题成功，提示跳转
                //$data = $base->responseAjax("并入专题成功", "并入专题成功", "<a href='/admin_sArticle' class='btn btn-default'>点击返回</a>");
                //return $data;
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
            if(DB::table("base_article_re_subject")->insert($insert_data))
            {
                //成功
                $base->setRedirectMessage(true, "添加标签失败", null, null);
                return redirect()->back();
            }
            else
            {
                //失败
                $base->setRedirectMessage(false, "添加标签失败",  null, null);
                return redirect()->back();
            }
        }
        //dump($input_data);
    }
    //删除文章
    public function dArticle(BaseFunc $base,$article_id)
    {
        if(DB::table("base_article")->where("article","=",$article_id)->delete())
        {
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
        $input_data['subject_data'] = DB::table('base_article_subject')->get();
        return view("Admin.Article.subjectlist",$input_data);
    }
    //(进行更新)
    public function uSubject(BaseFunc $base)
    {
        $sunject_update_data = Request::only("subject_id","subject_name","subject_intro");
        $sunject_update_data['subject_update_date']=  date("Y-m-d H:i:s");
        if(DB::table("base_article_subject")->
                where("subject_id","=",$sunject_update_data["subject_id"])
                ->update($sunject_update_data))
        {
            //修改成功，提示跳转
            $base->setRedirectMessage(true, "并入专题成功", null, null);
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
    public function dSubject(BaseFunc $base,$subject_id)
    {
        //删除base_article_subject表的指定专题
        if(DB::table("base_article_subject")->where("subject_id","=","$subject_id")->delete())
        {
            //return  response()->json(['status'=>'true','message'=>'删除成功']);
            $base->setRedirectMessage(true, "删除专题成功", null, null);
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
    public function aSubject(BaseFunc $base)
    {
        $subject_add_data = Request::only("subject_name","subject_intro"); 
        $subject_add_data['subject_create_date']=date("Y-m-d H:i:s");
        if(DB::table("base_article_subject")->insert($subject_add_data))
        {
            //添加成功，提示跳转
            $base->setRedirectMessage(true, "添加专题成功", null, null);
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
        $input_data['subject_by_id'] = DB::table("base_article_subject")->where("subject_id","=",$subject_id)->first();
        //dump($input_data);exit();
        //获取当前专题下的所有文章信息
        $input_data['article_by_subject'] = DB::table("base_article_subject")->leftJoin("base_article_re_subject","subject_id","=","relation_subject")->
                leftJoin("base_article","relation_article","=","article_id")->where("subject_id","=",$subject_id)->get();
        //dump($input_data);
        return view("Admin.Article.moresubject",$input_data);
    }
    
    //从专题移除一篇文章
    public function RemoveArticleToSubject(BaseFunc $base,$subject_id,$article_id)
    {
        if(DB::table("base_article_re_subject")
                ->where("relation_subject","=",$subject_id)
                ->where("relation_article","=",$article_id)
                ->update(["relation_subject"=>null]))
        {
            //移除成功，提示跳转
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
    public function _uLebel(BaseFunc $base)
    {
        $input_data = Request::only("label_id","label_name","label_create_date","label_update_date");
        $input_data['label_update_date']= date("Y-m-d H:i:s");
        if(DB::table("base_article_label")->where("label_id","=",$input_data['label_id'])
                ->update($input_data)
                )
        {
            //修改成功，提示跳转
            $data = $base->setRedirectMessage(true, "标签修改成功",null,null);
            return redirect()->back();
        }
        else
        {
            //修改失败，提示跳转
           $data = $base->setRedirectMessage(false, "标签修改失败",null,null);
            return redirect()->back();
        }
    }
    public function dLebel(BaseFunc $base,$label_id)
    {
        if(DB::table("base_article_label")->where("label_id","=",$label_id)->delete())
        {
            $data = $base->setRedirectMessage(true, "标签删除成功", "返回", "/admin_sLebel");
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
    public function aLebel(BaseFunc $base)
    {
        $input_data = Request::only("label_name");
        if($input_data['label_name'] == "")
        {
            $data = $base->setRedirectMessage(false, "添加标签失败", "返回", "/admin_aLebel");
            return $data;
        }
        $input_data['label_create_date']=date("Y-m-d H:i:s");
        if(DB::table("base_article_label")->insert($input_data))
        {
            $data = $base->setRedirectMessage(true, "添加标签成功", "返回", "/admin_sLebel");
            return $data;
        }
        else
        {
            $data = $base->setRedirectMessage(false, "添加标签失败", "返回", "/admin_aLebel");
            return $data;
        }
    }
    public function aAticleLabel(BaseFunc $base)
    {
        $input_data = Request::only("article_id","label_id");
        $insert_data['relation_article']=$input_data['article_id'];
        $insert_data['relation_label']=$input_data['label_id'];
        if(DB::table("base_article_re_label")->where("relation_article","=",$input_data['article_id'])
                ->where("relation_label","=",$input_data['label_id'])
                ->get())//判断文章是否已有标签
        {
            //此文章有了标签就执行修改
            if(DB::table("base_article_re_label")->where("relation_article","=",$input_data['article_id'])
                    ->update(["relation_label"=>$input_data['label_id']]))
            {
                //修改成功
                $data = $base->setRedirectMessage(true, "文章标签修改成功", "返回", "/admin_sArticle");
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
            if(DB::table("base_article_re_label")->insert($insert_data))
            {
                //成功
                $data = $base->setRedirectMessage(true, "添加标签失败", "返回", "/admin_sArticle");
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
        $input_data['class_data'] = DB::table("base_article_class")->orderBy("class_create_date","desc")->paginate(3);
        //dump($input_data);
        return view("Admin.Article.sClass",$input_data);
    }
    //修改类别
    public function uClass(BaseFunc $base)
    {
        $input_data = Request::only("class_id","class_name");
        if(DB::table("base_article_class")->where("class_id","=",$input_data['class_id'])->update($input_data))
        {
            //成功
            $base->setRedirectMessage(true, "修改分类成功", null, null);
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
    public function dClass(BaseFunc $base,$class_id)
    {
        if(DB::table("base_article_class")->where("class_id","=",$class_id)->delete())
        {
            //成功
            $base->setRedirectMessage(true, "删除成功", null, null);
            return redirect()->back();
        }
        else
        {
            //失败
            $base->setRedirectMessage(false, "删除成功", null, null);
            return redirect()->back();
        }
    }
    //添加分类
    public function aClass(BaseFunc $base)
    {
        $input_data = Request::only("class_name");
        if(DB::table("base_article_class")->insert($input_data))
        {
            //成功
            $base->setRedirectMessage(true, "添加分类成功", null, null);
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
