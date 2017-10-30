<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 15:53
 */

namespace BaseClass\Component\Image;
use Illuminate\Support\Facades\DB;

/**
 * Class ImageClass
 * @package BaseClass\Component\Image
 */
class ImageClass
{
    /**
     * 图片id
     * @var
     */
    private $class_id;
    /**
     * 图片表的一条记录
     * @var
     */
    public $info;

    /**
     * 按照指定的方式去查找图片类
     * @param $query_limit
     * @return mixed
     */
    static function select($query_limit)
    {
        /*
         * $limit
         * |-user   按照用户筛选
         * |-class_id 按照图片类Id筛选
         * |-sort   排序方式
         * |-num    每页条数
         * |-start  开始
         * |-desc 是否倒序列
         * |-paginate 是否分页
         * |-first 是否返回一条记录
         *
         *
         * $return_data
         * |-status 是否成功
         * |-message 消息
         * |-data   数据 DB返回的二维结构
         *
         */
        $query = DB::table("base_image_class");


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
        //筛选图片类id
        if(isset($query_limit["class_id"]))
        {
            $query = $query -> where("class_id","=",$query_limit["class_id"]);
        }


        if(isset($query_limit["first"]) && $query_limit["first"] == true)
        {
            $classArray = $query -> first();
        }
        else
        {
            //是否分页
            if(isset($query_limit["paginate"]) && $query_limit["paginate"]==true)
            {
                $classArray = $query -> paginate(9);
            }
            else
            {
                $classArray = $query -> get();
            }

        }


        //获取数据并返回
        //  $classArray = $query ->get();

        $return_data["status"] = true;
        $return_data["message"] = "成功获取到数据";
        $return_data["data"] = $classArray;
        return $return_data;

    }


    /**
     * @param $inputData
     * @return bool
     */
    static function add($inputData)
    {
       $data = DB::table('base_image_class')->insert($inputData);
        if($data)
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    /**
     * @param $class_id
     */
    public function __construct($class_id)
    {
        $this->class_id=$class_id;
        $this -> syncBaseInfo();
    }

    /**
     * @return bool
     */
    public function syncBaseInfo()
    {
        $first =  DB::table('base_image_class')
            ->where('class_id','=',$this->class_id)
            ->first();
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
     * @param $inputData
     * @return bool
     */
    public function update($inputData)
    {
        $class_id = $this ->class_id;

        $update = DB::table('base_image_class')->where("class_id","=",$class_id)->update($inputData);
        if($update <= 0)
        {
            return false;
        }
        else
        {
            return true;
        }

    }

    /**
     * @return bool
     */
    public function delete()
    {
        $class_id = $this -> class_id;
        $user = session("user.user_id");
        $delete = DB::table("base_image_class")->where("class_user","=",$user)->where("class_id","=",$class_id)->delete();
        if($delete != 0)
        {
            return true;
        }
        else
        {
            return false;
        }

    }




}