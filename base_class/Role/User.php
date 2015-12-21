<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 13:56
 */

namespace BaseClass\Role;
use BaseClass\Component\Article\Article;
use Illuminate\Support\Facades\DB;
class User
{

    public $info;
    public $article_list;
    public $subject_list;
    public $image_list;
    public $collect_list;
    private $user_id;



    /*-------------------------*/
    static function addUser($user_array)
    {
        $user_array["user_create_date"]=date('Y-m-d H:i:s');
        if(DB::table("base_user")->where("user_username","=","$user_array[user_username]")!==NULL){return false;}

        if(DB::table("base_user")->insert($user_array))
        {
            echo"添加成功！";
        }
        else
        {
            echo"添加失败！";
        }
    }

    /**
     * @param $info_array 登陆信息数组
     * @return User
     */
    static function login($user_array)
    {
        $userData = DB::table("base_user")
            ->where("user_username", "=","$user_array[user_username]")
            ->where("user_password", "=", md5("$user_array[user_password]"))
            ->first();
        if ($userData != NULL) {
            return $userData;
        } else {
            return false;
        }
    }
    static function qqLogin($acs_token, $open_id)
    {

    }
    static function qqRegister()
    {

    }



    public function __construct($user_id)
    {

        $this->user_id = $user_id;
        $this->syncBaseInfo($user_id);
        $this->syncArticleInfo($user_id);
        $this->syncSubjectInfo($user_id);
        $this->syncImageInfo($user_id);
        $this->syncCollectInfo($user_id);
    }
    public function init()
    {
        $id= $this->user_id;
        $this->syncBaseInfo($id);
        $this->syncArticleInfo($id);
        $this->syncSubjectInfo($id);
        $this->syncImageInfo($id);
        $this->syncCollectInfo($id);
    }

    public function logout()
    {
        $this->user_id=0;
        $this->init();

    }
    public function update($user_array)
    {
        if(DB::table("base_user")
                ->where("user_id","=",$this->user_id)
                ->first() == NULL) {return false;}

        $user_array["user_update_date"]=date('Y-m-d H:i:s');


        DB::table("nase_user")->where('user_id', $this->user_id)->update($user_array);
        /*$this->bug_handle_user=DB::table('base_user')
            ->where('user_id', $this->user_id)
            ->update(['user_username' => $user_array["user_username"]]);
        $this->bug_handle_user=DB::table('base_user')
            ->where('user_id', $this->user_id)
            ->update(['user_password' => $user_array["user_password"]]);
        $this->bug_handle_user=DB::table('base_user')
            ->where('user_id', $this->user_id)
            ->update(['user_nickname' => $user_array["user_nickname"]]);
        $this->bug_handle_user=DB::table('base_user')
            ->where('user_id', $this->user_id)
            ->update(['user_update_date' => $user_array["user_update_date"]]);
        $this->bug_handle_user=DB::table('base_user')
            ->where('user_id', $this->user_id)
            ->update(['user_age' => $user_array["user_age"]]);
        $this->bug_handle_user=DB::table('base_user')
            ->where('user_id', $this->user_id)
            ->update(['user_sex' => $user_array["user_sex"]]);
        $this->bug_handle_user=DB::table('base_user')
            ->where('user_id', $this->user_id)
            ->update(['user_intro' => $user_array["user_intro"]]);
        $this->bug_handle_user=DB::table('base_user')
            ->where('user_id', $this->user_id)
            ->update(['user_image' => $user_array["user_image"]]);
        $this->bug_handle_user=DB::table('base_user')
            ->where('user_id', $this->user_id)
            ->update(['user_email' => $user_array["user_email"]]);*/


        $this->init();
    }

    /*---------------end----------------------*/




    /*--------------------*/
    public function syncBaseInfo()
    {
        if(DB::table("base_user")->where("user_id","=",$this->user_id)->first() == NULL) {return false;}

        $this->info =DB::table("base_user")
            ->where("user_id","=","$this->user_id")
            ->first();


    }

    public function syncArticleInfo()
    {
        if(DB::table("base_user")->where("user_id","=",$this->user_id)->first() == NULL) {return false;}

        $this->article_list =DB::table("base_article")
            ->where("article_user","=",$this->user_id)
            ->first();
    }

    public function syncSubjectInfo()
    {
        if(DB::table("base_user")->where("user_id","=",$this->user_id)->first() == NULL) {return false;}

        $this->subject_list =DB::table("base_article_subject")
            ->where("subject_user","=",$this->user_id)
            ->first();
    }

    public function syncImageInfo()
    {
        if(DB::table("base_user")->where("user_id","=",$this->user_id)->first() == NULL) {return false;}

        $this->image_list =DB::table("base_image")
            ->where("image_user","=",$this->user_id)
            ->first();
    }

    public function syncCollectInfo()
    {
        if(DB::table("base_user")->where("user_id","=",$this->user_id)->first() == NULL) {return false;}

        $this->collect_list =DB::table("base_article_collect")
            ->where("collect_user","=",$this->user_id)
            ->first();
    }
    /*---------------end-------------------*/









}