<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\UserPowerFunc;
use GirdPlugins\Base\LogFunc;

class ImageController extends Controller {
    
    public function getImage($image_id=0)
    {
        ob_end_clean(); 
        if($image_id == 0)
        {
            header("Content-type:image/jpeg");
            readfile($_SERVER["DOCUMENT_ROOT"]."/file/2015110804393618330.jpg");
        }
        $imageData = DB::table("base_image")
                ->where("image_id","=",$image_id)
                ->first();
        if($imageData!=NULL)
        {
            $path =  $imageData->image_path;
            $format = $imageData->image_format;
            switch( $format ) {
                case "gif": $ctype="image/gif"; break;
                case "png": $ctype="image/png"; break;
                case "jpeg":
                case "jpg": $ctype="image/jpeg"; break;
                default: $ctype="image/jpeg"; 
            }
            
            header('Content-type: ' . $ctype);
            readfile($path);
            
        }
        else //如果没有图片的，换上一张默认图片
        {
            header("Content-type:image/jpeg");
            readfile($_SERVER["DOCUMENT_ROOT"]."/image/default.jpg");
        }
       
    }
    
    
    
    /*
        提供给UE编辑器的上传图片页面
     *      */
    
    
     /* 得到上传文件所对应的各个参数,数组结构
 * array(
 *     "state" => "SUCCESS",          //上传状态，上传成功时必须返回"SUCCESS"
 *     "url" => "/getImage/".$id,            //返回的地址
 *     "title" => getClientOriginalExtension() ,          //新文件名
 *     "original" => getClientOriginalName(),       //原始文件名
 *     "type" => $file->getClientOriginalExtension(),            //文件类型
 *     "size" => $file->getClientSize()           //文件大小
      );
    */
    
    public function putImage(BaseFunc $baseFunc, LogFunc $logFunc, UserPowerFunc $UserPowerFunc)
    {
        ob_end_clean();
        date_default_timezone_set("Asia/chongqing");
        error_reporting(E_ERROR);
        header("Content-Type: text/html; charset=utf-8");
        //session(["test"=>date('Y-m-d H:i:s')]);
         //dump(Request::all());
        if (!request::hasFile('upfile')) {

           $requsetJson = array(
                    "state" => "无文件",          //上传状态，上传成功时必须返回"SUCCESS"
                    );
             return json_encode($requsetJson);
            
            
        } else {
            //从前端提取文件
            $file = Request::file('upfile');

            //提取文件名
            $fileName = $file->getClientOriginalName();


            //移动文件到指定目录
            $path = $_SERVER['DOCUMENT_ROOT'] .config("my_config.image_upload_dir"). session("user.user_id")."/";  //存贮文件的绝对路径
            $name = date('YmdHis') . session("user.user_id") . rand(1000, 9999) . "." . $file->getClientOriginalExtension();  //自动生成路径


            $file->move($path, $name);  //移动
            //把文件相关数据插入数据库
            $input_data["image_name"] ="编辑器上传图片".$name;  //改文件名1
            $input_data["image_format"] = $file->getClientOriginalExtension();   //文件格式
            $input_data["image_intro"] = "编辑器上传图片".$name;
            $input_data["image_path"] = $path.$name;  //绝对路径
            $input_data["image_user"] = session("user.user_id");

            //操作记录
            $log_array["log_level"] = 0;
            $log_array["log_title"] = "使用ue编辑器向base_image表中插入一条记录";
            $log_array["log_detail"] = "使用ue编辑器向base_image表中插入一条记录";
            $log_array["log_date"] = date('Y-m-d H:i:s');
            $log_array["log_user"] = session("user.user_id");


            if (!$UserPowerFunc->checkUserPower(7)) {                    //权限验证
                 $requsetJson = array(
                    "state" => "无权限",          //上传状态，上传成功时必须返回"SUCCESS"
                    );
                 return json_encode($requsetJson);
            }
            if ($id = DB::table("base_image")->insertGetId($input_data)){
                  
                $requsetJson = array(
                    "state" => "SUCCESS",          //上传状态，上传成功时必须返回"SUCCESS"
                    "url" => config("my_config.website_url")."/getImage/".$id,            //返回的地址
                   "title" => $id ,          //新文件名
                    "original" => "",       //原始文件名
                   "type" => ".".$file->getClientOriginalExtension(),            //文件类型
                    "size" => $file->getClientSize()           //文件大小
                        );
                $logFunc->insertLog($log_array);    //插入操作记录
                return response()->json($requsetJson);
            } else {
                $requsetJson = array(
                    "state" => "无法插入数据库",          //上传状态，上传成功时必须返回"SUCCESS"
                    );
                return json_encode($requsetJson);
                
            }
        }
    }

   
}