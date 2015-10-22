<?php
namespace GirdPlugins\Base;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class ArticleFunc
{
     /**
     * 获取一个用户的类
     * @access public
     * @param array $log_array
        
     * @return Bool (成功/失败)
      * 
     */
    public function getUserClass($userId)
    {
        $userClass = DB::table("base_article_class")->where("class_user","=",$userId)->get();
        return $userClass;
        
    }
    
    /**
     * 添加一篇文章
     * @access public
     * @param array $articleData 
     * ["article_title","article_intro","article_class","article_sort","article_detail"];需要这些字段
     * 
     * @return Bool (成功/失败)
      * 
     */
    public function addArticle($articleData)
    {
        $articleDataDump["article_create_date"]=date('Y-m-d H:i:s');//strtotime(date('Y-m-d H:i:s'));
        $articleDataDump["article_update_date"]=date('Y-m-d H:i:s');//strtotime(date('Y-m-d H:i:s'));
        $articleDataDump["article_true"]=true;
        $articleDataDump["article_user"]=session("user.user_id");
        $articleDataDump["article_sort"]=0;
        $articleDataDump["article_click"]=0;
        $articleDataDump["article_star"]=0;
        $articleData = array_merge($articleDataDump,$articleData);
        DB::table("base_article")->insert($articleData);
        dump($articleData);
        
        
        //
    }
}
