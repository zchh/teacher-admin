<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 15:51
 */

namespace BaseClass\Component\Article;
use Illuminate\Support\Facades\DB;

/**
 * Class ArticleClass
 * @package BaseClass\Component\Article
 */
class ArticleClass
{
    private $info;
    /**
     * @access public
     * @param $info_array
     */
    static function add($info_array)
    {
        $info_array['class_create_date']=date("Y-m-d H:i:s");
        DB::table('base_article_class')
            ->insert($info_array);
    }
    /**
     * 通过user_id获取到该用户的所有文章类别
     * @access public
     * @param $user_id
     * @return array
     */
    static function getMoreByUser($user_id)
    {
        $article_class = DB::table('base_article_class')
            ->join('base_user','user_id','=','class_user')
            ->where('class_user','=',$user_id)
            ->get();
        return $article_class;
    }

    /**
     * 构造函数
     * @param $class_id
     */
    public function __construct($class_id)
    {
        $this->class_id=$class_id;
        $this->syncBaseInfo();
    }
    /**
     * 进行操作过后获取最新的文章类别
     * @access public
     * @return array
     */
    public function syncBaseInfo()
    {
         $info = DB::table('base_article_class')
            ->where('class_id','=',$this->class_id)
            ->first();
        $this->info = $info;
        return $info;
    }
    /**
     * 更新文章类别
     * @access public
     * @param $info_array
     */
    public function update($info_array)
    {
        $info_array['class_update_date']=date("Y-m-d H:i:s");
        DB::table('base_article_class')
            ->where('class_id','=',$this->class_id)
            ->update($info_array);
        $this->syncBaseInfo();
    }
    /**
     * 删除文章类别
     * @access public
     */
    public function delete()
    {
        DB::table('base_article_class')
            ->where('class_id','=',$this->class_id)
            ->delete();
    }
}