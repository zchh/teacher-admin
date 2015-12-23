<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 15:53
 */

namespace BaseClass\Component\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class Image
{
    /*
     * 原本系李作强
     * 张池负责修改
     * 在图片页面中的增删改查
     * 1.对于添加修改删除等，成功失败返回bool
     * 2.添加修改删除图片 要参照User/ImageController中的数据
     * 3.查找单张图片显示请参照Index/ImagesController getImage 我们指定这个函数作为所有图片的入口
     * 重构后他将调用本类来实现功能
     *
     *
     * 在文章页面的（模态框）的增删改查
     * 1.将原来的代码重构成使用这些类的
     *
     *
     * */

    //图片id
    private $image_id;
    //图片表的一条记录
    private $info;

    /*按照指定的方式去查找图片类*/
    static function select($query_limit)
    {
        /*
         * $limit
         * |-user   按照用户筛选
         * |-class 按照图片类筛选
         * |-image_id 按照image_id来筛选
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
        $query = DB::table("base_image");


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
                $query = $query->orderBy("image_id","desc");
            }
            else
            {
                $query = $query->orderBy("image_id");
            }
        }

        //筛选用户
        if(isset($query_limit["user"]))
        {
            $query = $query->where("image_user","=",$query_limit["user"]);
        }

        //筛选图片类
        if(isset($query_limit["class"]))
        {
            $query = $query->where("image_class","=",$query_limit["class"]);
        }

        //筛选图片id
        if(isset($query_limit["image_id"]))
        {
            $query = $query->where("image_id","=",$query_limit["image_id"]);
        }


          //是一条记录，还是多条记录
         if(isset($query_limit["first"]) && $query_limit["first"] == true)
         {
             $classArray = $query -> first();
         }
        else
        {
            //是否分页
            if(isset($query_limit["paginate"]))
            {
                if($query_limit["paginate"] <= 0)
                {
                    $classArray = $query -> get();
                }
                else{
                    $classArray = $query -> paginate($query_limit["paginate"]);
                }

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


        static function getMoreByUser($user_id)
    {
        $image = DB::table('base_image')
            ->where('image_user','=',$user_id)
            ->get();
        return $image;
    }

    //
    static function getMoreByClass($class_id)
    {

        if($class_id == NULL)
        {
            $combine['base_image'] = DB::table('base_image')    //为了获得图片用户，要合并两张表
            ->where("image_user","=",session("user.user_id"))
                ->orderBy("image_id","desc")
                ->paginate(9); //分页，两条记录一页
            $combine["nowClass"] = "所有分类";

        }
        else
        {
            $combine['base_image'] = DB::table('base_image')    //为了获得图片用户，要合并两张表
            ->where("image_user","=",session("user.user_id"))
                ->where("image_class","=",$class_id)
                ->orderBy("image_id","desc")
                ->paginate(9); //分页，两条记录一页
            $combine["nowClass"] = DB::table("base_image_class")->where("class_id","=",$class_id)->first()->class_name;

        }

        $combine["imageClassData"] = DB::table("base_image_class")
            ->where("class_user","=",session("user.user_id"))->get();


        return $combine;

        /*
        $image = DB::table('base_image')
            ->join('base_image_class','class_id','=','image_class')
            ->where('class_id','=',$class_id)
            ->get();
        return $image;
        */
    }

    static function add($inputData,$file)
    {
        //1.文件移动
        $storage_path = config("my_config.image_upload_dir"). session("user.user_id")."/";  //存贮文件的相对路径
        $path = $_SERVER['DOCUMENT_ROOT'].$storage_path;  //存贮文件的绝对路径
        $name = date('YmdHis') . session("user.user_id") . rand(1000, 9999) . "." . $file->getClientOriginalExtension();  //自动生成路径
        Request::file('image_file')->move($path, $name);  //移动文件到指定目录

        //2.数据库添加
        //获取与前端file相关的数据库量
        $inputData["image_format"] = $file->getClientOriginalExtension();   //文件格式
        $inputData["image_path"] = $storage_path.$name;  //绝对路径
        $inputData["image_user"] = session("user.user_id");

        $add = DB::table('base_image')
            ->insert($inputData);
        if ($add)
        {
            return true;
        }
        return false;
    }

    public function __construct($image_id)
    {
        $this->image_id=$image_id;
        $this -> syncBaseInfo();
    }
    public function syncBaseInfo()
    {
       $first =  DB::table('base_image')
            ->where('image_id','=',$this->image_id)
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


    public function update($inputData)
    {
        $userId = session("user.user_id");    //提取用户id

        $imageInfo = $this ->info;
        if($imageInfo == false)
        {
            return false;
        }
        if ($imageInfo -> image_user != $userId) {
          return false;
        }

        $count = DB::table('base_image')->where('image_user', '=', $userId)
            ->where('image_id', '=', $inputData["image_id"])
            ->update(['image_intro' => $inputData["image_intro"], 'image_name' => $inputData["image_name"],"image_class" => $inputData["image_class"]]);   //修改图片介绍
        if($count == 0)
        {
            return false;
        }
        return true;
        /*
        DB::table('base_image')
        ->where('image_id','=',$this->image_id)
        ->update($info_array);
        */
    }

    /*这里应该传入一个user_id 然后比对图片拥有则是不是该用户*/
    public function delete()
    {
        $image_id = $this -> image_id;
        $userId = session("user.user_id");    //提取用户id
       $imageInfo = $this -> info;
        if($imageInfo == false)
        {
            return false;
        }
        if($imageInfo -> image_user != $userId)
        {
            return false;
        }
        //1.先删除数据库的,用事务回滚，方便之后如果删了还可以恢复。删的同时要把image_id，路径提取出来
        DB::beginTransaction();    //开始事务
        $count = DB::table('base_image')->where('image_user', '=', $userId)->where('image_id', '=', $image_id)->delete();  //先删数据库的
        if ($count == 0) {
               return false;
        }

        //2.删文件里的
        $getPath =  $_SERVER['DOCUMENT_ROOT'].$imageInfo->image_path;  //提取路径
            if (unlink($getPath)) { //unlink是删除里面的路径
                DB::commit();     //提交事务：
                return true;
            }
            return false;

    }




}