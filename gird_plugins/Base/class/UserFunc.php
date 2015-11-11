<?php
namespace GirdPlugins\Base;
use \Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
//use GirdPlugins\Base\BaseFunc;
class UserFunc
{
    /**
     * 
     * @access public
     * @param int $powerId
     * 
     *
     * @return Bool
     */
    //用户注册功能
    public function addUser($input_data)
    {
        
        $input_data['user_group'] = 1;
        $input_data['user_password'] = md5($input_data['user_password']);
        $input_data['user_create_date'] = date("Y-m-d H:i:s");
        //判断此用户是否注册过
        if(DB::table("base_user")->where("user_username","=",$input_data['user_username'])->get())
        {
            return false;
        }
        DB::beginTransaction();
        if($user_id = DB::table("base_user")->insertGetId($input_data))
        {
            
            //如果注册成功，再给用户一个默认专题
            $subject_array['subject_name'] = $input_data['user_username']."的专题";
            $subject_array['subject_create_date'] = date("Y-m-d H:i:s");
            $subject_array['subject_user'] = $user_id;
            $subject_id = DB::table("base_article_subject")->insertGetId($subject_array);
            //给注册用户添加一篇默认文章类别
            $class_id = DB::table("base_article_class")->insertGetId([
                "class_user"=>$user_id,
                "class_create_date"=>date("Y-m-d H:i:s"),
                "class_name"=>"默认"
            ]);
            //给注册用户添加一片默认文章
            $article_id = DB::table("base_article")->insertGetId([
                "article_create_date"=>date("Y-m-d H:i:s"),
                "article_user"=>$user_id,
                "article_title"=>"php开发",
                "article_class"=>$class_id
            ]);
            //把专题与文章关联起来
            DB::table("base_article_re_subject")->insert([
                "relation_subject"=>$subject_id,
                "relation_article"=>$article_id
            ]);
            DB::commit();
            return true;
        }
        else
        {
            return false;
        }
        //dump($input_data);
    }
    public function getUserPower($powerId)
    {
        
    }
}