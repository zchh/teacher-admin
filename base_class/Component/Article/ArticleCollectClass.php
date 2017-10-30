<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 17:52
 */

namespace BaseClass\Component\Article;
use Illuminate\Support\Facades\DB;


class ArticleCollectClass
{
    public $info;
    public $collect_list;
    //添加一个收藏夹
    static function add($info_array)
    {
        $info_array['class_create_date']=date('Y-m-d H:i:s',time());
        $info_array['class_user'] = session("user.user_id");
        if(DB::table("base_article_collect_class")->insert($info_array))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //按照用户获取所有的收藏夹
    static function getMoreByUser($user_id)
    {
        $result=DB::table("base_article_collect_class")->where("class_user","=",$user_id)->get();
        if($result)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }

    //传入id构造
    public function __construct($class_id)
    {
        $this->class_id=$class_id;
        $this->syncBaseInfo();
        $this->syncArticleInfo();
    }

    //同步基本信息 和 在当前搜藏夹的信息，保存在$this->info 和$this->collect_list
    public function syncBaseInfo(){

        $result=DB::table("base_article_collect_class")
            ->where("class_id","=",$this->class_id)->first();
        if($result)
        {
            $this->info=$result;
            return true;
        //return $this->info;
        }
        else
        {
            return false;
        }

    }
    public function syncArticleInfo()
    {
           $result=DB::table("base_article_collect")
               ->join("base_article","collect_article_id","=","article_id")
               ->where("collect_class","=",$this->class_id)->get();
        if($result)
        {
            $this->collect_list=$result;
            return true;
        }
        else
        {
            return false;
        }

    }

    //更新信息
    public function update($info_list)
    {
            if(DB::table("base_article_collect_class")->where('class_id','=',$this->class_id)->update($info_list))
            {
                $this->syncBaseInfo();
                return true;
            }
            else
            {
                return false;
            }
    }

    //删除  ，user_id 可选，如果传入，要检查是否是这个用户的
    public function delete()
    {
        if(DB::table("base_article_collect_class")->where('class_id','=',$this->class_id)->delete())
        {
            return true;
        }
        else
        {
            return false;
        }

    }

}