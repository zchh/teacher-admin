<?php
namespace GirdPlugins\Base;


use Illuminate\Support\Facades\DB;
class ArticleFunc
{
     /*

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
    

    
    /*

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

        $value = DB::table("base_article")->insert($articleData);
        return $value;
        //dump($articleData);

        
        //
    }

    
    /*
     * 获取用户所有的文章
     * @access public
     * @param array $userId 用户ID
     * @param string & $view 如果需要传一个做好的table视图回来，请给一个参数
     * 
     * 
     * @return array 所有文章的数组
     */
    public function getUserArticle($userId)
    {
        $data = DB::table("base_article")->where("article_user","=",$userId)->get();
        return $data;
        /*if($view!==false)
        {
            $inputData["articleData"] = $data;
            return view("Base::showRedirectMessage",$inputData);
        }
        else
        {
            return $data;
        }*/
    }
    /*
     * 删除一个用户的文章
     * @access public
     * @param array $userId 用户ID
     * @param string $article 文章ID
     * 
     * 
     * @return bool
     *
     *      */
    public function deleteUserArticle($userId,$articleId)
    {
        $result = DB::table("base_article")->where("article_id","=",$articleId)->where("article_user","=",$userId)
                ->delete();
        if($result == 0)
        {
            return false;
        }
        else 
        {
            return true;
        }
    }
    
    /*
     * 获取一篇文章的详情
     * @access public
     * @param array $userId 用户ID
     * @param string $article 文章ID
     * 
     * 
     * @return array 文章信息的对象
     *      */
    public function getArticleDetail($detailId)
    {
        return DB::table("base_article")->where("article_id","=",$detailId)->first();
    }
    
    
     /*
     * 修改一篇文章
     * @access public
     * @param array $articleData 文章类容数组
     * 
     * @return bool
     *      */
    public function updateArticleDetail($articleData)
    {
        
    }
    
  

}
