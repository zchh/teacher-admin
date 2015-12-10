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
    public function delete()
    {
        DB::tabel('base_image')
            ->where('image_id','=',$this->image_id)
            ->delete();
    }
}