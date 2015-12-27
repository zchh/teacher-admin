<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use GirdPlugins\Base\BaseFunc;
use GirdPlugins\Base\UserPowerFunc;      //zc
use BaseClass\Base\UserPowerGroup;  //2015/12/21
use BaseClass\Component\Image\Image;  //2015/12/21
use BaseClass\Component\Image\ImageClass;

class ImageController extends Controller {

    public function sImage() {

        session(["nowPage" => "/user_sImage"]);
        $class_id = Request::input("class_id",NULL);


        $query_image_limit["paginate"] = 9;
        $query_image_limit["desc"] = true;
        $query_image_limit["user"] = session("user.user_id");
        if($class_id == null)
        {
            $combine["nowClass"] = "所有分类";
        }
        else
        {
            $query_image_limit["class"] = $class_id;

            $query_image_class_limit["class_id"] = $class_id;
            $query_image_class_limit["first"] = true;
            $query_image_class = ImageClass::select($query_image_class_limit);
            $combine["nowClass"] = $query_image_class["data"] -> class_name;
        }
        $returnImage = Image::select($query_image_limit);
        $combine["base_image"] = $returnImage["data"];

        $query_class_limit["user"] = session("user.user_id");
        $returnClass = ImageClass::select($query_class_limit);
        $combine["imageClassData"] = $returnClass["data"];


        return view("User.Image.sImage", $combine);
    }

    public function aImage(BaseFunc $baseFunc, UserPowerFunc $UserPowerFunc) {   //增加图片

        if (!UserPowerGroup::checkUserPower(7)) {
            $baseFunc->setRedirectMessage(false, "错误，无权限", NULL);
            return redirect()->back();
        }

        if (!request::hasFile('image_file')) {

            $baseFunc->setRedirectMessage(false, "错误，上传失败", NULL);

            return redirect()->back();  //跳回上一页
        }
            //从前端提取文件
            $file = Request::file('image_file');

            //获取与前端file无关的数据库量
            $inputData["image_name"] = $_POST["image_name"];  //改文件名1
            $inputData["image_intro"] = $_POST["image_intro"];
            if(isset($_POST["image_class"]))
            {
                $inputData["image_class"] = $_POST["image_class"];
            }

           $return = Image::add($inputData,$file);
            if($return == true)
            {
                $baseFunc->setRedirectMessage(true, "数据插入成功", NULL);
                return redirect()->back();  //跳回上一页
            }
            else
            {
                $baseFunc->setRedirectMessage(false, "数据库查找失败", NULL);
                return redirect()->back();  //跳回上一页

            }
    }

    public function dImage($image_id, BaseFunc $baseFunc, UserPowerFunc $UserPowerFunc) {

        if (!UserPowerGroup::checkUserPower(7)) {
            return redirect()->back();
        }

        $image = new Image($image_id);
        $return = $image->delete();
        if($return == true)
        {
            $baseFunc->setRedirectMessage(true, "删除文件成功", NULL);
            return redirect()->back();  //跳回上一页
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "删除文件失败", NULL);
            return redirect()->back();  //跳回上一页
        }

    }

    public function uImage(BaseFunc $baseFunc) {

        if (!UserPowerGroup::checkUserPower(7)) {
            $baseFunc->setRedirectMessage(false, "此用户无权修改此文件", NULL);
            return redirect()->back();
        }

        $inputData = Request::only("image_id", "image_intro", "image_name","image_class");

        $image = new Image($inputData["image_id"]);
        $return = $image -> update($inputData);
        if($return == false)
        {
            $baseFunc->setRedirectMessage(false, "修改文件失败", NULL);
            return redirect()->back();
        }
        else
        {
            $baseFunc->setRedirectMessage(true, "修改文件成功", NULL);
            return redirect()->back();

        }
    }

    public function sImageInFrame() {

        $query_image_limit["paginate"] = 6;
        $query_image_limit["user"] = session("user.user_id");
        $returnImage = Image::select($query_image_limit);
        $inputData["image"]= $returnImage["data"];

        $query_class_limit["user"] = session("user.user_id");
        $returnImageClass = ImageClass::select($query_class_limit);
        $inputData["imageClassData"] = $returnImageClass["data"];

        $nowChoseImageId = session("image.image_id");
        if ($nowChoseImageId != NULL) {
            $query_image_id_limit["image_id"] = session("image.image_id");
            $query_image_id_limit["first"] = true;
            $returnImageObject = Image::select($query_image_id_limit);
            $nowChoseImageData =  $returnImageObject["data"];
            if($nowChoseImageData == null)
            {
                $inputData["nowChoseImageSrc"] = NULL;
            }
            else
            {
                $inputData["nowChoseImageSrc"] = "/getImage/".$nowChoseImageData->image_id;
            }
        } else {
            $inputData["nowChoseImageSrc"] = NULL;
    }

        return view("User.Image.sImageInFrame", $inputData);
    }

    public function sImageIdInFrame($image_id, BaseFunc $baseFunc) {
        //判断是否是此用户，判断是否是此image_id的照片

        if ($image_id != null) {
            $query_image_limit["user"] = session("user.user_id");
            $query_image_limit["image_id"] = $image_id;
            $query_image = Image::select($query_image_limit);
            $get = $query_image["data"];
            if ($get == null) {
                $baseFunc->setRedirectMessage(false, "此用户无权选择此图片", NULL);
                return redirect()->back();
            }
            $inputData["image_id"] = $image_id;
            session(["image" => $inputData]);
        }
        else {
            $inputData["image_id"] = null;
            session(["image" => $inputData]);
        }
        return redirect()->back();

    }
    
    
    /*添加图片类别*/
    public function aImageClass(BaseFunc $baseFunc)
    {
        $insert_data = Request::only("class_name");
        $insert_data["class_user"] = session("user.user_id");
        $insert_data["class_create_date"] = date('Y-m-d H:i:s');
        $return = ImageClass::add($insert_data);
        if($return == true)
        {
            $baseFunc->setRedirectMessage(true, "添加成功", NULL);
            return redirect()->back();
        }
        else
        {
            $baseFunc->setRedirectMessage(false, "添加出错", NULL);
            return redirect()->back();
        }
       
    }
    
    public function uImageClass(BaseFunc $baseFunc)
    {
        $insertData = Request::only("class_name","class_id");

        $imageClass = new ImageClass($insertData["class_id"]);
        $return = $imageClass -> update($insertData);


        if($return == true)
        {
            $baseFunc->setRedirectMessage(true, "修改成功", NULL);
            return redirect()->back();

        }
        else
        {
            $baseFunc->setRedirectMessage(false, "修改出错", NULL);
            return redirect()->back();
        }
    }
    
    public function dImageClass($class_id,BaseFunc $baseFunc)
    {

        $image = new ImageClass($class_id);
        $return = $image ->delete();
        if($return == true)
        {
            $baseFunc->setRedirectMessage(true, "删除成功", NULL);
            return redirect()->back();

        }
        else
        {
            $baseFunc->setRedirectMessage(false, "删除出错", NULL);
            return redirect()->back();
        }
    }

}
