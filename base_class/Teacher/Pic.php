<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 15:53
 */

namespace BaseClass\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use BaseClass\Base\UserPowerGroup;

class Pic
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


    /**
     * 图片id
     * @var
     */
    private $id;
    /**
     * 图片表的一条记录
     * @var
     */
    private $info;


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
        $query = DB::table("t_pic");


        //筛选图片类
        if(isset($query_limit["type"]))
        {
            $query = $query->where("type","=",$query_limit["type"]);
        }

        //筛选图片id
        if(isset($query_limit["id"]))
        {
            $query = $query->where("id","=",$query_limit["id"]);
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


    /**
     * @param $class_id
     * @return mixed
     */
    static function getMoreByClass($class_id)
    {

        if($class_id == NULL)
        {
            $combine['base_image'] = DB::table('base_image')
                ->where("image_user","=",session("user.user_id"))
                ->orderBy("image_id","desc")
                ->paginate(9); //分页，两条记录一页
            $combine["nowClass"] = "所有分类";

        }
        else
        {
            $combine['base_image'] = DB::table('base_image')
                ->where("image_user","=",session("user.user_id"))
                ->where("image_class","=",$class_id)
                ->orderBy("image_id","desc")
                ->paginate(9); //分页，两条记录一页
            $combine["nowClass"] = DB::table("base_image_class")->where("class_id","=",$class_id)->first()->class_name;

        }

        $combine["imageClassData"] = DB::table("base_image_class")
            ->where("class_user","=",session("user.user_id"))->get();


        return $combine;
    }

    /**
     * @param $inputData
     * @param $file
     * @return bool
     */
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

    /**
     * 上传图片
     * @param $type
     * @param $file
     * @return bool
     */
    static function addPic($type, $file){
        //1.文件移动
        $storage_path = config("my_config.image_upload_dir");  //存贮文件的相对路径
        $path = $_SERVER['DOCUMENT_ROOT'].$storage_path;  //存贮文件的绝对路径
        $name = date('YmdHis').rand(1000, 9999) . "." . $file->getClientOriginalExtension();  //自动生成路径
        $file->move($path, $name);  //移动文件到指定目录
      //  Request::file('pic')->move($path, $name);  //移动文件到指定目录
        //2.数据库添加
        //获取与前端file相关的数据库量
        $arr["format"] = $file->getClientOriginalExtension();   //文件格式
        $arr['type'] = $type;
        $arr['path'] = $storage_path.$name;  //绝对路径
        $id = DB::table('t_pic')
            ->insertGetId($arr);
        if(false == $id) {
            return false;
        }
        return $id;
    }

    /**
     * 编辑图片
     * @param $file
     * @return mixed
     */
    public function editPic($file){
        //上传
        $storage_path = config("my_config.image_upload_dir")."/";  //存贮文件的相对路径
        $path = $_SERVER['DOCUMENT_ROOT'].$storage_path;  //存贮文件的绝对路径
        $name = date('YmdHis').rand(1000, 9999) . "." . $file->getClientOriginalExtension();  //自动生成路径
        Request::file('pic')->move($path, $name);  //移动文件到指定目录
        $arr['path'] =  $storage_path.$name;
        $first =  DB::table('t_pic')
            ->where('id','=',$this->id)
            ->update($arr);
        return $first;
    }

    /**
     * @param $id
     */
    public function __construct($id){
        $this->id = $id;
        $this->syncBaseInfo();
    }

    public function syncBaseInfo(){
        $info = DB::table('t_pic')->where('id','=',$this->id)->first();
        $this->info = $info;
        return $info;
    }

    /**
     *
     * @return bool
     */
    public function delete(){
        $info = $this->info;
        if(false == $info) {
            return false;
        }
        //1.先删除数据库的,用事务回滚，方便之后如果删了还可以恢复。删的同时要把image_id，路径提取出来
        DB::beginTransaction();    //开始事务
        $count = DB::table('t_pic')->where('id', '=', $this->id)->delete();  //先删数据库的
        if ($count == 0) {
            return false;
        }
        //2.删文件里的
        $getPath =  $_SERVER['DOCUMENT_ROOT'].$info->path;  //提取路径
        if (unlink($getPath)) { //unlink是删除里面的路径
            DB::commit();     //提交事务：
            return true;
        }
        return false;
    }

    /**
     * @param $id
     */
    static function getPicById($id){
        if($id == 0) {
            header("Content-type:image/jpeg");
            readfile($_SERVER["DOCUMENT_ROOT"]."/image/default.jpg");
        }
        $imageData = DB::table("t_pic")
            ->where("id","=",$id)
            ->first();
        if($imageData!=NULL) {
            $path =  $imageData->path;
            $format = $imageData->format;
            switch( $format ) {
                case "gif": $ctype="image/gif"; break;
                case "png": $ctype="image/png"; break;
                case "jpeg":
                case "jpg": $ctype="image/jpeg"; break;
                default: $ctype="image/jpeg";
            }
            header('Content-type: ' . $ctype);
            readfile($_SERVER['DOCUMENT_ROOT'].$path);
        }
        else{ //如果没有图片的，换上一张默认图片{
            header("Content-type:image/jpeg");
            readfile($_SERVER["DOCUMENT_ROOT"]."/image/default.jpg");
        }
    }


}