<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use BaseClass\Component\Image\Image;
use GirdPlugins\Base\BaseFunc;

class ImageController extends Controller {
    
    public function getImage($image_id=0)
    {
        ob_end_clean();
        Image::addByUE($image_id);
    }

    /*
        提供给UE编辑器的上传图片页面
    */

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
    
    public function putImage(BaseFunc $baseFunc)
    {

        ob_end_clean();
        error_reporting(E_ERROR);
        header("Content-Type: text/html; charset=utf-8");
        $data = Image::putImageByUE();
        if ($data["status"] == true)
        {
            return  response()->json($data["requestJson"]);
        }
        else
        {
            return json_encode($data["requsetJson"]);
        }

    }

   
}