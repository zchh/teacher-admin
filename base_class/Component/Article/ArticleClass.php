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
    private $info;

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
         *
         * $return_data
         * |-status 是否成功
         * |-message 消息
         * |-data   数据 DB返回的二维结构
         *
         */
        $query = DB::table("base_article_class");


        //起始条数
        if ( isset($query_limit["start"])  )
        { $query = $query->skip($query_limit["start"]);}


        //每页条数
        if(isset($query_limit["num"]))
        {
            if($query_limit["num"]==0)//如果指定0，直接就不用返回数据了
            {
                $return_data["status"] = true;
                $return_data["message"] = "查看到数据，但数量限制为0";
                $return_data["data"] = [];
                return $return_data;
            }
            $query = $query->take($query_limit["num"]);
        }
        else
        {
            $query = $query->take(config("my_config.default_num_page"));
        }



        //排序
        if(  isset($query_limit["sort"])  )
        {
            if(isset($query_limit["desc"])  && true==$query_limit["desc"])
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
            if(isset($query_limit["desc"])  && true==$query_limit["desc"])
            {
                $query = $query->orderBy("class_id","desc");
            }
            else
            {
                $query = $query->orderBy("class_id");
            }
        }

        //筛选用户
        if(isset($query_limit["user"]))
        {
            $query = $query->where("class_user","=",$query_limit["user"]);
        }



        //获取数据并返回
        $classArray = $query ->get();

        $return_data["status"] = true;
        $return_data["message"] = "成功获取到数据";
        $return_data["data"] = $classArray;
        return $return_data;



    }

    /**
     * @access public
     * @param $info_array
     */
    static function add($info_array)
    {
        $info_array['class_create_date']=date("Y-m-d H:i:s");
        return DB::table('base_article_class')
            ->insert($info_array);
    }
    /**
     * 通过user_id获取到该用户的所有文章类别
     * @access public
     * @param $user_id
     * @return array
     */
    static function getMoreByUser($user_id,$render=false)
    {
        $article_class = DB::table('base_article_class')
            ->where('class_user','=',$user_id);
        if ($render == true)
        {
            $article_class = $article_class->simplePaginate(10);
        }
        else
        {
            $article_class = $article_class->get();
        }

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
    public function update($info_array,$user_id = NULL)
    {
        $info_array['class_update_date']=date("Y-m-d H:i:s");
        $r = DB::table('base_article_class')
            ->where('class_id','=',$this->class_id);
        if(isset($user_id))
        {
            $r = $r->where("class_user","=",$user_id)->update($info_array);;
        }
        else
        {
            $r = $r->update($info_array);
        }

        $this->syncBaseInfo();
        return $r;
    }
    /**
     * 删除文章类别
     * @access public
     */
    public function delete($user_id = NULL)
    {
        $r  = DB::table('base_article_class')
            ->where('class_id','=',$this->class_id);
        if(isset($user_id))
        {
            return $r->where("class_user","=",$user_id) ->delete();
        }
        else
        {
            return $r ->delete();
        }


    }
}