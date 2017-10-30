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
 * Class ArticleReply
 * @package BaseClass\Component\Article
 */
class ArticleReply
{

    /**
     * @var
     */
    private $reply_id;

    /**
     * @var
     */
    public $info;

    /**
     * 查询 select
     */
    static function select($query_limit)
    {

        /*
       * $limit
       * |-user   按照用户筛选
       * |-class_id 按照reply_id筛选
       * |-sort   排序方式
       * |-num    每页条数
       * |-start  开始
       * |-desc 是否倒序列
       * |-paginate 是否分页
       * |-first 是否返回一条记录
       * |-join_article_and_user 是否和合并base_article表和base_user表

       *
       * $return_data
       * |-status 是否成功
       * |-message 消息
       * |-data   数据 DB返回的二维结构
       *
       */
        $query = DB::table("base_article_reply");



        //合并base_article和base_user表
        if(isset($query_limit["join_article_and_user"]) && $query_limit["join_article_and_user"] == true)
        {
            $query = $query -> leftJoin("base_article","reply_article","=","article_id")
                            -> leftJoin("base_user","article_id","=","user_id");
        }


        //起始条数
        if ( isset($query_limit["start"]))
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
            $query = $query->take(config("my_config.default_num_page")); //默认数量页面
        }



        //排序
        if(  isset($query_limit["sort"])  )   //按数据库某一字段来排
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
                $query = $query->orderBy("reply_id","desc");
            }
            else
            {
                $query = $query->orderBy("reply_id");
            }
        }

        //筛选用户
        if(isset($query_limit["user"]))
        {
            $query = $query->where("reply_user","=",$query_limit["user"]);
        }
        //筛选reply_id
        if(isset($query_limit["reply_id"]))
        {
            $query = $query -> where("reply_id","=",$query_limit["reply_id"]);
        }


        if(isset($query_limit["first"]) && $query_limit["first"] == true)
        {
            $replyArray = $query -> first();
        }
        else
        {
            //是否分页
            if(isset($query_limit["paginate"]))
            {
                if($query_limit["paginate"] <= 0)
                {
                    $replyArray = $query -> get();
                }
                else{
                    $replyArray = $query -> paginate($query_limit["paginate"]);
                }
            }
            else
            {
                $replyArray = $query -> get();
            }

        }


        //获取数据并返回
        //  $classArray = $query ->get();

        $return_data["status"] = true;
        $return_data["message"] = "成功获取到数据";
        $return_data["data"] = $replyArray;
        return $return_data;

    }


    /**
     * @param $reply_id
     * 传入reply_id 实例化一条评论的对象
     */
    public function __construct($reply_id)
    {
        $this->reply_id=$reply_id;
        $this -> syncBaseInfo();
    }

    /**
     * 传入一个数组，添加一条评论
     * @param $info_array
     * @return bool
     */
    static function addReply( $info_array)
    {

        $return_id = DB::table("base_article_reply")->insertGetId($info_array);
        if($return_id == null)
        {
            return false;

        }
        else
        {
            return $return_id;
        }


    }

    /**
     * 向base_reply_relation表添加记录
     * @param $info_array
     * @return bool
     */
    static function addRelation($info_array)
    {
        $return = DB::table("base_reply_relation")->insert($info_array);
        if($return == true)
        {
            return true;

        }
        else
        {
            return false;
        }
    }


    /**
     * 同步信息
     * @return bool
     */
    public function syncBaseInfo()
    {
        $replyId = $this -> reply_id;
        $first =  DB::table('base_article_reply')-> where("reply_id","=",$replyId) ->first();
        if($first == null)
        {
            return false;
        }
        else
        {
            $this ->info = $first;
            return true;
        }

    }


    /**
     * 评论删除
     * @return bool
     */
    public function delete()
    {
        $reply_id = $this -> reply_id;
        $deleteRelation = DB::table("base_reply_relation")->where("relation_child","=",$reply_id)->delete();
        $delete =  DB::table("base_article_reply")->where("reply_id","=",$reply_id)->delete();
        if($deleteRelation > 0 && $delete > 0)
        {
            return true;
        }
        else
        {
            return false;
        }

    }



}
