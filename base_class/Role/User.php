<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 13:56
 */

namespace BaseClass\Role;

use Illuminate\Support\Facades\DB;
use BaseClass\Base\UserPowerGroup;

/**
 * Class User
 * @package BaseClass\Role
 */
class User
{

    public $info;
    private $article_list;
    private $subject_list;
    private $image_list;
    private $collect_list;
    private $user_id;



    /*-------------------------*/
    /**
     * @param $info_array
     * @return User|bool
     */
    static function addUser($input_data)
    {
        $input_data["user_create_date"]=date('Y-m-d H:i:s');
        $input_data["user_update_date"]=date('Y-m-d H:i:s');
        $input_data["user_group"]=1;
        $input_data["user_password"]=md5($input_data["user_password"]);
        $userExisted=DB::table("base_user")
            ->where("user_username","=",$input_data["user_username"])
            ->pluck("user_username");
        if($userExisted!=null){return false;}
        $user_id=DB::table("base_user")
            ->insertGetId($input_data);
        return new User($user_id);
    }

    /**
     * @param $info_array 登陆信息数组
     * @return User
     */
    static function login($inputData)
    {
        $userData = DB::table("base_user")
            ->where("user_username","=",$inputData["user_username"])
            ->where("user_password","=",md5($inputData["user_password"]))
            ->first();

        if(!$userData)
        {
            return false;
        }

        $userObj = new User($userData->user_id);
        $userObj->updateSession($userData);

        return $userObj;
    }

    /**
     * @param $acs_token
     * @param $open_id
     */
    static function qqLogin($acs_token, $open_id)
    {

    }

    /**
     *
     */
    static function qqRegister()
    {

    }


    /**
     *
     * @param $user_id
     */
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

    /**
     * @return bool
     */
    public function logout()
    {
        Session::flush();

        return true;
    }

    /**
     * 修改用户信息*/
    public function update($personalMessageData)
    {
        $personalMessageData["user_update_date"]=date('Y-m-d H:i:s');
         if(DB::table("base_user")->where("user_id","=",$this->user_id)->update($personalMessageData))
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    /*---------------end----------------------*/


    /**
     * @return bool
     */
    public function syncBaseInfo()
    {
        if(DB::table("base_user")->where("user_id","=",$this->user_id)->first() == NULL)
        {
            return false;
        }
        $this->info=DB::table("base_user")
            ->where("user_id","=",$this->user_id)
            ->first();
            return true;

    }

    /**
     * @return bool
     */
    public function syncArticleInfo()
    {
        if(DB::table("base_article")->where("article_user","=",$this->user_id)->first() == NULL)
        {
            return false;
        }

        $this->article_list=DB::table("")
            ->where("article_user","=","$this->user_id")
            ->get("article_id");
            return true;
    }

    /**
     * @return bool
     */
    public function syncSubjectInfo()
    {
        if(DB::table("base_article_subject")->where("subject_user","=",$this->user_id)->first() == NULL)
        {
            return false;
        }
        $this->subject_list=DB::table("base_article_subject")
            ->where("subject_user","=",$this->user_id)
            ->get("subject_id");
            return true;

    }

    /**
     * @return bool
     */
    public function syncImageInfo()
    {
        if(DB::table("base_image")->where("image_user","=",$this->user_id)->first() == NULL)
        {
            return false;
        }
        $this->image_list=DB::table("")
            ->where("image_user","=",$this->user_id)
            ->get("image_id");
            return true;
    }

    /**
     * @return bool
     */
    public function syncCollectInfo()
    {
        if(DB::table("base_article_collect")->where("collect_user","=",$this->user_id)->first() == NULL)
        {
            return false;
        }
        $this->collect_list=DB::table("base_article_collect")
            ->where("collect_user","=",$this->user_id)
            ->get("collect_id");
            return true;
    }

    /**
     *
     */
    public function updateSession($userData)
    {
        $powerGroupObj = new UserPowerGroup($this->info->user_group);
        $sessionInitData["user_status"] = true;
        $sessionInitData["user_id"] = $userData->user_id;
        $sessionInitData["user_nickname"] = $userData->user_nickname;
        $sessionInitData["user_group"] = $userData->user_group;
        $sessionInitData["user_image"] = $userData->user_image;
        session(["user"=>$sessionInitData]);
        $powerGroupObj->loadUserPowerToSession();

        return $sessionInitData;
    }

    public function getArticleByAttentioned($user_id)
    {

        $data = DB::table("base_article")
            ->join("base_user_relation", "relation_focus", "=", "article_user")
            ->join("base_user", "user_id", "=", "article_user")
            ->where("relation_user", "=", $user_id)
            ->orderBy("article_id", "desc")
            ->simplePaginate(10);
        return $data;
    }

    /*---------------end-------------------*/









}