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
                $return_data["status"] = false;
                $return_data["message"] = "你没有权限查看";
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
        if ( isset($query_limit["user"]))
        {
            if($query_limit["user"] === 0 && session("user.user_id",0)!==null)    //如果限制用户id为0 且有session  这种情况是查询当前用户
            {
                $query_limit["user"] = session("user.user_id");
            }
            else //限制id不为0 说明确定用户
            {
                if($query_limit["user"]!==session("user.user_id",null))
                    //如果是查看的别人的也需要验证管理员权限
                {

                    if(!AdminPowerGroup::checkAdminPower(6)){
                        $return_data["status"] = false;
                        $return_data["message"] = "你没有权限查看";
                        return $return_data;
                    };
                    $query = $query->where("article_user","=",$query_limit["user"]);
                }
                //查看自己的验证session通过即可
                else
                {

                    $query = $query->where("article_user","=",$query_limit["user"]);
                }
            }


        }//如果没有表示用户，就要显示所有的用户，那么需要检查是否有权限
        else
        {
            if(!AdminPowerGroup::checkAdminPower(6)){
                $return_data["status"] = false;
                $return_data["message"] = "你没有权限查看";
                return $return_data;
            };
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