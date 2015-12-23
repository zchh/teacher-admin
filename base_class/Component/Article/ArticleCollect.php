<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 17:51
 */

namespace BaseClass\Component\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class ArticleCollect
{
 public $info;

 public $collect_id;

   /*
    * 按照条件查询收藏
    * */
    static function select($query_limit)
    {

    }
    /*
     * 传递一个数组进入函数
     * $info_array
     * 添加成功返回一个收藏项的实例，失败false
     * */
    static function add($info_array)
    {
      $info_array['collect_create_date']=date('Y-m-d H:i:s',time());
      $info_array['collect_update_date']=date('Y-m-d H:i:s',time());
     $info_array['collect_user'] = session("user.user_id");
      $result=DB::table("base_article_collect")->insertGetId($info_array);
     if($result)
     {
      return  new ArticleCollect($result);
     }
     else
     {
       return false;
     }

    }

    /*
     * 构造函数，传入一个收藏id
     * */
    public function __construct($collect_id)
    {
      $this->collect_id=$collect_id;
     $this->syncBaseInfo();

    }

    /*
     * 同步数据收藏的基本信息 存放到$this->info
     * */
    public function syncBaseInfo()
    {
     $result=DB::table("base_article_collect")->where('collect_article_id','=',$this->collect_id)->first();
     if($result)
     {
      $this->info=$result;
        // return $result;
     }
     else
     {
      return false;
     }
    }

    /*
     *更新信息，传入一个更新字段数组
     * 成功返回true 失败false
     * */
    public function update($info_array)
    {
         $info_array['collect_update_date']=date('Y-m-d H:i:s',time());
         if(DB::table("base_article_collect")->where("collect_id","=",$this->collect_id)->update($info_array))
         {
          $this->syncBaseInfo();
          return true;
         }
        else
        {
         return false;
        }

    }
    /*
     * 删除一个收藏（根据$this->info->collect_id），可选传入user_id,如果存在该字段，应该检测该收藏是不是这个用户的
     * */
    public function remove()
    {
         if(DB::table("base_article_collect")->where('collect_id','=',$this->collect_id)->delete())
         {
          return true;
         }
         else
         {
          return false;
         }
    }
}