<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 13:58
 */

namespace BaseClass\Component\Article;
use BaseClass\Base\AdminPowerGroup;
use Illuminate\Support\Facades\DB;

class Article
{

    private $info;
    private $reply_list;

    /**
     * @param $query_limit
     * @return array
     */
    static function select($query_limit)
    {
        /*
         * $query_limit
         * |-start  起始
         * |-num    结束页数
         * |-class  类别
         * |-sort   排序
         * |-search 搜索关键字
         * |-user   特殊用户（如果不设置会检查是否有管理员权限，通过后查询所有用户,设为0则直接查当前用户）
         * |-desc   是否逆转排序即倒序(默认正序)
         * |-subject 专题限制
         * |*/

        /*
         * $return_data
         * |-status 是否成功
         * |-message 消息
         * |-data   数据 DB返回的二维结构
         * |-num    数据总条数
         * |*/
        $query = DB::table("base_article");




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
                $query = $query->orderBy("article_id","desc");
            }
            else
            {
                $query = $query->orderBy("article_id");
            }
        }
        //按用户查找
        if ( isset($query_limit["user"]) )
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


        //关键字
        if ( isset($query_limit["search"])  )
        {
            $query = $query->where("article_title","like","%".$query_limit["search"]."%");
        }
        //专题限制
        if(isset($query_limit["subject"]))
        {
            $query = $query->join("base_article_re_subject","relation_article","=","article_id")
            ->join("base_article_subject","relation_subject","=","subject_id")
                ->where("subject_id","=",$query_limit["subject"]);

        }
        //筛选类别
        if ( isset($query_limit["class"])  )
        {
            $query = $query->where("article_class","=",$query_limit["class"]);
        }



        //计算出总条数
        $num_query  = clone $query;//克隆出来不适用原来的对象
        $return_data["total"] = $num_query->select(DB::raw('count(*) as num'))->first()->num  ;

        //起始条数
        if ( isset($query_limit["start"])  )
        { $query = $query->skip($query_limit["start"]);}


        //每页条数
        if(isset($query_limit["num"]))
        {
            if($query_limit["num"]==0){
                $return_data["status"] = true;
                $return_data["message"] = "查询到数据,但num设为了0";
                $return_data["data"] =  null;
                return $return_data;
            }
            $query = $query->take($query_limit["num"]);
        }
        else
        {
            $query = $query->take(config("my_config.default_num_page"));
        }

        //关联到类
        $query = $query->leftJoin("base_article_class","class_id","=","article_class");

        $return_data["status"] = true;
        $return_data["message"] = "成功获取到数据";
        $return_data["data"] =  $query->get();
        return $return_data;



    }

    static function add($info_array)
    {

    }

    public function __construct()
    {

    }
    public function syncBaseInfo()
    {

    }
    public function syncReplyInfo()
    {

    }

    public function update()
    {

    }
    public function delete()
    {

    }
}