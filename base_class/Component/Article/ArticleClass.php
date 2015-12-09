<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 15:51
 */

namespace BaseClass\Component\Article;
use Illuminate\Support\Facades\DB;
use BaseClass\Base\AdminPowerGroup;
/**
 * Class ArticleClass
 * @package BaseClass\Component\Article
 */
class ArticleClass
{

    static function select($query_limit)
    {
        /*
         * $limit
         * |-user   按照用户筛选
         * |-sort   排序方式
         * |-num    每页条数
         * |-start  开始
         * |-desc 是否倒序列
         *
         */
        $query = DB::table("base_article_class");


        //起始条数
        if ( isset($query_limit["start"])  )
        { $query = $query->skip($query_limit["start"]);}


        //每页条数
        if(isset($query_limit["num"]))
        {
            if($query_limit["num"]==0){return [];}
            $query = $query->take($query_limit["num"]);
        }
        else
        {
            $query = $query->take(config("my_config.default_num_page"));
        }



        //排序
        if(  isset($query_limit["sort"])  )
        {
            if(true==$query_limit["desc"])
            {
                $query = $query->orderBy($query_limit["sort"],"desc");
            }
            else
            {
                $query = $query->orderBy($query_limit["sort"]);
            }

        }
        else
        {
            if(isset($query_limit["desc"])  && true == $query_limit["reverse"])
            {
                $query = $query->orderBy("class_id","desc");
            }
            else
            {
                $query = $query->orderBy("class_id");
            }
        }
        //按用户查找
        if ( isset($query_limit["user"]) )
        {
            if($query_limit["user"]!=session("user.user_id"))
                //如果是查看的别人的也需要验证权限，自己的不用
            {

                if(!AdminPowerGroup::checkAdminPower(6)){return false;};
                $query = $query->where("class_user","=",$query_limit["user"]);
            }
            else
            {

                $query = $query->where("class_user","=",$query_limit["user"]);
            }

        }//如果没有表示用户，就要显示所有的用户，那么需要检查是否有权限
        else
        {
            if(!AdminPowerGroup::checkAdminPower(6)){return false;};
        }
        return $query ->get();

    }

    /**
     * @param $info_array
     *
     */
    static function add($info_array)
    {

    }
    static function getMoreByUser($user_id)
    {

    }

    public function __construct(){}
    public function syncBaseInfo(){}
    public function update()
    {

    }
    public function delete()
    {

    }
}