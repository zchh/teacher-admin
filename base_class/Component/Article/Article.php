<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 13:58
 */

namespace BaseClass\Component\Article;
use Illuminate\Support\Facades\DB;

class Article
{

    private $info;
    private $reply_list;

    /**
     * 通过user_id获取到该用户的所有article
     * @access public
     * @param $user_id
     * @return array
     */
    static function getMoreByUser($user_id)
    {
        $article = DB::table('base_article')
            ->leftjoin('base_user','article_user','=','user_id')
            ->where('article_user','=',$user_id)
            ->get();
        return $article;
    }

    /**
     * 通过user_id获取到该用户的所有subject
     * @access public
     * @param $user_id
     * @return array
     */
    static function getMoreBySubject($user_id)
    {
        $article_subject = DB::table('base_article_subject')
            ->join('base_user','subject_user','=','user_id')
            ->where('subject_user','=',$user_id)
            ->get();
        return $article_subject;
    }

    /**
     * 添加article
     * @access public
     * @param $info_array
     */
    static function add($info_array)
    {
        $info_array['article_create_date']=date("Y-m-d H:i:s");
        $info_array['article_true']=1;
        $info_array['article_sort']=1;
        $info_array['article_click']=0;
        $info_array['article_star']=0;
        $info_array['article_reply']=0;
        DB::table('base_article')
            ->insert($info_array);
//        echo 123;
    }

    /**
     * 构造函数
     * @param $article_id
     */
    public function __construct($article_id)
    {
        $this->article_id=$article_id;
        $this->syncBaseInfo();
    }

    /**
     * 操作过后返回最新的文章信息
     * @access public
     * @return array
     */
    public function syncBaseInfo()
    {
        $this->info = DB::table('base_article')
            ->where('article_id','=',$this->article_id)
            ->first();
        return $this->info;
    }
    /**
     * 查询该条article的回复
     * @access public
     * @return array
     */
    public function syncReplyInfo()
    {
        $this->reply_list = DB::table('base_article_reply')
            ->leftjoin('base_article','article_id','=','reply_article')
            ->where('reply_article','=',$this->article_id)
            ->get();
        return $this->reply_list;
    }
    /**
     * 修改article
     * @access public
     * @param $info_array
     */
    public function update($info_array)
    {
        $info_array['article_update_date']=date("Y-m-d H:i:s");
        DB::table('base_article')
            ->where('article_id','=',$this->article_id)
            ->update($info_array);
    }
    /**
     * 删除article
     * @access public
     */
    public function delete()
    {
        DB::table('base_article')
            ->where('article_id','=',$this->article_id)
            ->delete();
    }
}