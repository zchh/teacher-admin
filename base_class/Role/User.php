<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 13:56
 */

namespace BaseClass\Role;

use Illuminate\Support\Facades\DB;

class User
{

    private $info;
    private $article_list;
    private $subject_list;
    private $image_list;
    private $collect_list;
    private $user_id;



    /*-------------------------*/
    static function addUser($info_array)
    {
        $info_array["user_create_date"]=date('Y-m-d H:i:s');
        $info_array["user_update_date"]=date('Y-m-d H:i:s');
        $userExisted=DB::table("base_user")
            ->where("user_username","=","$info_array[user_username]")
            ->pluck("user_username");
        if($userExisted!=null){return false;}
        $user_id=DB::table("base_user")
            ->insertGetId($info_array);
        return new User($user_id);
    }

    /**
     * @param $info_array 登陆信息数组
     * @return User
     */
    static function login($info_array)
    {
        $userData=DB::table("base_user")
            ->where("user_username","=","$info_array[user_username]")
            ->pluck("user_password");

        if($userData==null) {return false;}
        if($userData!=$info_array["user_password"]){return false;}

        return true;
    }
    static function qqLogin($acs_token, $open_id)
    {

    }
    static function qqRegister()
    {

    }



    public function __construct($user_id)
    {
       $this->user_id=$user_id;
        $this->syncBaseInfo();


        /**
         * 仅测试时使用

       $this->syncArticleInfo();
        $this->syncSubjectInfo();
        $this->syncImageInfo();
        $this->syncCollectInfo();

         */
    }
    public function logout()
    {
        Session::flush();

        return null;
    }

    /**
     * 修改用户信息*/
    public function update($info_array)
    {
        $info_array["user_update_date"]=date('Y-m-d H:i:s');
         if(DB::table("base_user")->where("user_id","=",$this->user_id)->update($info_array))
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    /*---------------end----------------------*/




    /*--------------------*/
    public function syncBaseInfo()
    {
        if(DB::table("base_user")->where("user_id","=",$this->user_id)->first() == NULL)
        {
            return false;
        }
        $this->info=DB::table("base_user")
            ->where("user_id","=","$this->user_id")
            ->first();

    }

    public function syncArticleInfo()
    {
        if(DB::table("base_article")->where("article_user","=",$this->user_id)->first() == NULL)
        {
            return false;
        }

        $this->article_list=DB::table("")
            ->where("article_user","=","$this->user_id")
            ->get("article_id");
    }

    public function syncSubjectInfo()
    {
        if(DB::table("base_article_subject")->where("subject_user","=",$this->user_id)->first() == NULL)
        {
            return false;
        }
        $this->subject_list=DB::table("base_article_subject")
            ->where("subject_user","=",$this->user_id)
            ->get("subject_id");

    }

    public function syncImageInfo()
    {
        if(DB::table("base_image")->where("image_user","=",$this->user_id)->first() == NULL)
        {
            return false;
        }
        $this->image_list=DB::table("")
            ->where("image_user","=",$this->user_id)
            ->get("image_id");
    }

    public function syncCollectInfo()
    {
        if(DB::table("base_article_collect")->where("collect_user","=",$this->user_id)->first() == NULL)
        {
            return false;
        }
        $this->collect_list=DB::table("base_article_collect")
            ->where("collect_user","=",$this->user_id)
            ->get("collect_id");
    }
    /*---------------end-------------------*/









}