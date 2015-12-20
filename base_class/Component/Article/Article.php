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
    private $article_id;

    static function getMoreByUser($user_id)
    {
        $result=DB::table("base_article")->where("article_user","=",$user_id)->get();
        if($result)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }
    static function getMoreBySubject($subject_id)
    {
        $result=DB::table("base_article")
            ->join("base_article_re_subject","article_id","=","relation_article")
            ->where("relation_subject","=",$subject_id)->get();
        if($result)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }
    static function add($info_array)
    {
        $info_array['article_create_date']=date('Y-m-d H:i:s',time());
        $info_array['article_update_date']=date('Y-m-d H:i:s',time());
        if(DB::table("base_article")->insert($info_array))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function __construct($article_id)
    {
        $this->article_id=$article_id;
        $this->syncBaseInfo();
        $this->syncReplyInfo();
    }
    public function syncBaseInfo()
    {

        $result=DB::table("base_article")->where("article_id","=",$this->article_id)->first();
        if($result)
        {
            $this->info = $result;
        }
        else
        {
            return false;
        }
    }
    public function syncReplyInfo()
    {
        $result=DB::table("base_article_reply")->where("reply_article","=",$this->article_id)->get();
        if($result)
        {
            $this->reply_list = $result;
        }
        else
        {
            return false;
        }
    }

    public function update($data)
    {
        $data["article_update_date"]=date('Y-m-d H:i:s',time());
        if(DB::table("base_article")->where("article_id","=",$this->article_id)->update($data))
        {
            return true;
        }
        else{
            return false;
        }

    }
    public function delete()
    {
        if(DB::table("base_article")->where("article_id","=",$this->article_id)->delete())
        {
            return true;
        }
        else{
            return false;
        }
    }
}