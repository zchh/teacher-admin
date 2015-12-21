<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 15:53
 */

namespace BaseClass\Component\Image;
use Illuminate\Support\Facades\DB;

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


    static function getMoreByUser($user_id)
    {
        $image = DB::table('base_image')
            ->where('image_user','=',$user_id)
            ->get();
        return $image;
    }
    static function getMoreByClass($class_id)
    {
        $image = DB::table('base_image')
            ->join('base_image_class','class_id','=','image_class')
            ->where('class_id','=',$class_id)
            ->get();
        return $image;
    }

    static function add($info_array)
    {
        DB::table('base_image')
            ->insert($info_array);
    }

    public function __construct($image_id)
    {
        $this->image_id=$image_id;
    }
    public function syncBaseInfo()
    {
        $image= DB::tabel('base_image')
            ->where('image_id','=',$this->image_id)
            ->first();
        return $image;
    }


    public function update($info_array)
    {
        DB::tabel('base_image')
        ->where('image_id','=',$this->image_id)
        ->update($info_array);
    }

    /*这里应该传入一个user_id 然后比对图片拥有则是不是该用户*/
    public function delete()
    {
        DB::tabel('base_image')
            ->where('image_id','=',$this->image_id)
            ->delete();
    }




}