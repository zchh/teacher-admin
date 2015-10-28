<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use GirdPlugins\Base\ArticleFunc;
use GirdPlugins\Base\BaseFunc;
 class ImageController extends Controller 
{
    public function sImage()
    {
        session(["nowPage"=>"/user_sImage"]);
         $combine['base_image'] = DB::table('base_image')    //为了获得图片用户，要合并两张表
                        ->join('base_user', 'base_image.image_user', '=', 'base_user.user_id')->paginate(2); //分页，两条记录一页
        // $data['base_image'] = DB::table('base_image')->get();
        
        return view("User.Image.sImage",$combine);
    }
    
    public function aImage(BaseFunc $baseFunc)   //增加图片
    { 
         
            if(!request::hasFile('image_file'))
        {
            $this->handle_indicate(false,"没有文件");
            return redirect()->back();  //跳回上一页
        }
        else
        {
            //从前端提取文件
            $file = Request::file('image_file');
            
            //提取文件名
            $fileName = $file->getClientOriginalName();

            
            //移动文件到指定目录
            $path = $_SERVER['DOCUMENT_ROOT']."/file/";  //存贮文件的绝对路径
           
            Request::file('image_file')->move($path,$fileName);
            
            //把文件相关数据插入数据库
            $input_data["image_name"] = $file -> getClientOriginalName();  //文件名
            $input_data["image_format"] = $file->getClientOriginalExtension();   //文件格式
            $input_data["image_intro"] = $_POST["image_intro"];                //
            $input_data["image_path"] = "/file/".$input_data["image_name"];  //绝对路径
            $input_data["image_user"] =  session("user.user_id");  
           // DB::table("base_image")->insert($input_data);
               if (DB::table("base_image")->insert($input_data)) 
                {
                $baseFunc->setRedirectMessage(true, "数据插入成功", NULL, "/user_sImage");
                }
                else 
                {
                $baseFunc->setRedirectMessage(false, "数据库查找失败", NULL, "/user_sImage");
                }
            
        }
    }
    public function dImage($image_id, BaseFunc $baseFunc) 
    {
        /*
        //第一：开启一个事务，让数据库和文件的删除同生共死
         DB::beginTransaction();   
         
       
         //先删文件里的
            $data = DB::table('base_image')->where('image_user', '=', session("user.user_id"))->where('image_id', '=', $image_id)->first();
             DB::beginTransaction();    //第一：开启一个事务，让数据库和文件的删除同生共死
            if ($image_id == $data->image_id) 
            {
            if (unlink($_SERVER['DOCUMENT_ROOT'] . $data->image_path)) //unlink是删除里面的路径
              {
                $baseFunc->setRedirectMessage(true, "删除文件成功", NULL, "/user_sImage");
              } 
              else 
                {
                $baseFunc->setRedirectMessage(false, "删除文件失败", NULL, "/user_sImage");
                }
             }
  
        
        $count = DB::table('base_image')->where('image_id', '=', $image_id)->delete();  //再删数据库的
        if ($count == 0) {
            DB::commit();   //提交事务
            $baseFunc->setRedirectMessage(false, "删除数据库文件失败", NULL, "/user_sImage");
        } else {
            $baseFunc->setRedirectMessage(true, "删除数据库文件成功", NULL, "/user_sImage");
        }
       
         */
        //1.先删除数据库的,用事务回滚，方便之后如果删了还可以恢复。删的同时要把image_id，路径提取出来
            DB::beginTransaction();    //提交事务
                                          //提取image_id，为之后删除文件做铺垫
            $get = DB::table('base_image')->where('image_id', '=', $image_id)->first(); //
            $getId = $get -> image_id;  //提取image_id
            $getPath = $get -> image_path;  //提取路径
            
            $count = DB::table('base_image')->where('image_id', '=', $image_id)->delete();  //再删数据库的
            if ($count == 0) {        
            $baseFunc->setRedirectMessage(false, "删除数据库文件失败", NULL, "/user_sImage");
            } else {
            $baseFunc->setRedirectMessage(true, "删除数据库文件成功", NULL, "/user_sImage");
            }
            
            
          //2.删文件里的  
             if ($image_id == $getId) 
            {
            if (unlink($_SERVER['DOCUMENT_ROOT'].$getPath)) //unlink是删除里面的路径
              {
                $baseFunc->setRedirectMessage(true, "删除文件成功", NULL, "/user_sImage");
                DB::commit();     //提交事务：
              } 
              else 
                {
                $baseFunc->setRedirectMessage(false, "删除文件失败", NULL, "/user_sImage");
                }
             }
        
        
             
        
        
       //2.删文件
         
       
    }
     
     public function uImage(BaseFunc $baseFunc)
     {
          $inputData = Request::only("image_id","image_intro","image_user_name");
          //dump($inputData);
       // 只改数据库的
         $count1 = DB::table('base_image')->where('image_id', '=',$inputData["image_id"] )->update(['image_intro' => $inputData["image_intro"]]);   //修改图片介绍
          $count2 = DB::table('base_image')->where('image_id', '=',$inputData["image_id"] )->update(['image_name' => $inputData["image_user_name"]]);   //修改图片名
          if( $count1*$count2 == 0)        
         {
              $baseFunc->setRedirectMessage(false, "修改图像文件失败", NULL, "/user_sImage");
         }
         else 
         {
              $baseFunc->setRedirectMessage(true, "修改图像文件成功", NULL, "/user_sImage");
         }
        
     }
}


