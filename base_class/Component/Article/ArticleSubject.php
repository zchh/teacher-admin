<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 15:52
 */

namespace BaseClass\Component\Article;
use Illuminate\Support\Facades\DB;


/**
 * Class ArticleSubject
 * @package BaseClass\Component\Article
 */
class ArticleSubject
{
    /**
     * @var
     */
    public $subject_id;
    /**
     * @var bool
     */
    public $subject_info;
    /**
     * @var bool
     */
    public $article_info;

    /**
     * @param $user_id
     * @return bool
     */
    static function getMoreByUser($user_id)
    {
       $result=DB::table("base_article_subject")->where("subject_user","=",$user_id)->get();
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }

    }

    /**
     * @param $info_array
     * @return bool
     */
    static function add($info_array)
    {
       if(empty($info_array['subject_user']))
       {
            $info_array['subject_user']=session("user.user_id");
       }
        $info_array['subject_create_date']=date('Y-m-d H:i:s',time());
        $info_array['subject_update_date']=date('Y-m-d H:i:s',time());
        if(DB::table("base_article_subject")->insert($info_array))
        {
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * @param $subject_id
     */
    public function __construct($subject_id)
    {
        $this->subject_id=$subject_id;
        $this->syncBaseInfo();
        $this->syncArticleInfo();

    }

    /**
     * @return bool
     */
    public function syncBaseInfo()
    {
        $subject_info=DB::table("base_article_subject")->where("subject_id","=",$this->subject_id)->get();
        if($subject_info)
        {
            $this->subject_info = $subject_info;

        }
        else
        {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function syncArticleInfo()
    {
        $article_info=DB::table("base_article_re_subject")
            ->join("base_article","relation_article","=","article_id")
            ->join("base_article_subject","relation_subject","=","subject_id")
            ->where("subject_id","=",$this->subject_id)
            ->get();
        if($article_info)
        {
            $this->article_info=$article_info;
            return $article_info;
        }
        else
        {
            return false;
        }
    }

    /**
     * @param $data
     * @return bool
     */
    public function SubjectUpdate($data)
    {
        $data["subject_update_date"]=date('Y-m-d H:i:s',time());
        if(DB::table("base_article_subject")->where('subject_id',"=","$this->subject_id")->update($data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function SubjectDelete()
    {
        if(DB::table("base_article_subject")->where('subject_id',"=","$this->subject_id")->delete())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @param $relation_article
     * @return bool
     */
    public function SubjectAddArticle($relation_article)
    {
        $data['relation_article']=$relation_article;
        $data['relation_subject']=$this->subject_id;
        $date['relation_sort']=0;
    if(DB::table("base_article_re_subject")->insert($data))
    {
        return true;
    }
        else
            {
                return false;
            }
    }

    /**
     * @param $relation_article
     * @return bool
     */
    public function SubjectRemoveArticle($relation_article)
    {
        if(DB::table("base_article_re_subject")->where("relation_article","=",$relation_article)->delete())
        {
            return true;
        }
        else
        {
            return false;
        }
    }


}