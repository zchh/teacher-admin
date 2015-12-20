<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2015/12/16
 * Time: 15:21
 */

namespace BaseClass\Component\Article;
use Illuminate\Support\Facades\DB;

class ArticleLabel
{
    //标签id
    private $label_id;
    private $info;
    //文章id
    //private $article_id;
    //专题id
    //private $subject_id;
    /**
     * 构造函数
     * @param $label_id
     * @param $article_id
     */
    public function __construct($label_id)
    {
        $this->label_id = $label_id;
        $this->syncBaseInfo();
    }
    /**
     * 进行操作过后获取最新的文章标签
     * @access public
     * @return array
     */
    public function syncBaseInfo()
    {
        $info = DB::table('base_article_label')
            ->where('label_id','=',$this->label_id)
            ->first();
        $this->info = $info;
        return $info;
    }
    /**
     * 添加文章标签
     * @access public
     * @param $info_array
     */
    public function add($info_array,$user_id = NULL)
    {
        //这里判断一下此条标签是否创建过
        if(DB::table("base_article_label")->where("label_name","=",$info_array['label_name'])->get())
        {
            return false;
        }
        $info_array['label_create_date'] = date("Y-m-d H:i:s");
        $r = DB::table("base_article_label");
        if(isset($user_id))
        {
            $r = $r->where("label_user","=",$user_id)->insert($info_array);
        }
        else
        {
            $r = $r->insert($info_array);
        }
        return $r;
    }
    /**
     * 修改文章标签
     * @access public
     * @param $info_array
     */
    public function update($info_array,$user_id = NULL)
    {
        $info_array['label_update_date'] = date("Y-m-d H:i:s");
        $r = DB::table("baes_article_label")
            ->where("label_id","=",$this->label_id);
        if(isset($user_id))
        {
            $r = $r->where("label_user","=",$user_id)->update($info_array);
        }
        else
        {
            $r = $r->update($info_array);
        }
        $this->syncBaseInfo();
        return $r;
    }
    /**
     * 删除文章标签
     * @access public
     */
    public function delete($user_id = NULL)
    {
        $r = DB::table("base_article_label")
            ->where("label_id","=",$this->label_id);
        if(isset($user_id))
        {
            return $r->where("label_user","=",$user_id)->delete();
        }
        else
        {
            return $r->delete();
        }
    }
    /**
     * 给文章添加标签
     * @access public
     * @param $article_id 被添加标签的文章ID
     */
    public function aAticleLabel($article_id)
    {
        //判断文章标签对是否已经有了
        if(DB::table("base_article_re_label")->where("relation_article","=",$article_id)
        ->where("relation_label","=",$this->label_id)->get() == null)
        {
            return DB::table("base_article_re_label")->insert(['relation_article'=>$article_id,'relation_label'=>$this->label_id]);
        }
        else
        {
            //标签已经添加过了
            return false;
        }
    }
    /**
     * 给文章添加标签
     * @access public
     * @param $article_id 被移除标签的文章ID
     */
    public function removeLabel($article_id)
    {
        if(DB::table("base_article_re_label")->where("relation_article","=",$article_id)
                ->where("relation_label","=",$this->label_id)->delete())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}