<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 13:58
 */

namespace BaseClass\Component\Article;
use Illuminate\Support\Facades\DB;
use BaseClass\Base\AdminPowerGroup;

class Article
{

    public $info;
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
         * |-num   每页条数
         * |-class  类别
         * |-sort   排序
         * |-search 搜索关键字
         * |-user   用户筛选（如果不设置查看所有文章）
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
            if(isset($query_limit["desc"]) &&true==$query_limit["desc"])
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
                $query = $query->orderBy("article_id","desc");
            }
            else
            {
                $query = $query->orderBy("article_id");
            }
        }

        //按用户查找
        if(isset($query_limit["user"]))
        {
            $query = $query->where("article_user","=",$query_limit["user"]);
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

    /**
     * 添加article
     * @access public
     * @param $info_array
     */
    static function add($info_array)
    {
        $info_array['article_create_date']=date("Y-m-d H:i:s");
        $info_array['article_true']=1;
        $info_array['article_sort']=1;
        $info_array['article_click']=0;
        $info_array['article_star']=0;
        $info_array['article_reply']=0;
        if(!isset($info_array['article_user'])){
            $info_array['article_user'] = session("user.user_id");
        }
        return DB::table('base_article')
            ->insert($info_array);

    }

    /**
     * 构造函数
     * @param $article_id
     */
    public function __construct($article_id)
    {
        $this->article_id=$article_id;
        $this->syncBaseInfo();
    }

    /**
     * 操作过后返回最新的文章信息
     * @access public
     * @return array
     */
    public function syncBaseInfo()
    {
        $this->info = DB::table('base_article')
            ->where('article_id','=',$this->article_id)
            ->first();
        return $this->info;
    }
    /**
     * 查询该条article的回复
     * @access public
     * @return array
     */
    public function syncReplyInfo()
    {
        $this->reply_list = DB::table('base_article_reply')
            ->leftjoin('base_article','article_id','=','reply_article')
            ->where('reply_article','=',$this->article_id)
            ->get();
        return $this->reply_list;
    }
    /**
     * 修改article
     * @access public
     * @param $info_array
     */
    public function update($info_array)
    {
        $info_array['article_update_date']=date("Y-m-d H:i:s");
        $result = DB::table('base_article')
            ->where('article_id','=',$this->article_id)
            ->update($info_array);
        $this->syncBaseInfo();
        return $result;
    }
    /**
     * 删除article
     * @access public
     */
    public function delete()
    {
        return DB::table('base_article')
            ->where('article_id','=',$this->article_id)
            ->delete();
    }
}