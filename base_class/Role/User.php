<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 13:56
 */

namespace BaseClass\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class User
{

    private $info;
    private $article_list;
    private $subject_list;
    private $image_list;
    private $collect_list;



    /*----------------������������--------------*/
    static function addUser($info_array)
    {

    }
    static function login($info_array)
    {

    }
    static function qqLogin($acs_token, $open_id)
    {
        //从三方接口回调函数那传过来的$acs_token，看看此条由用户进行QQ登录返回的记录绑定用户没有
        $data = DB::table("base_token")->join("base_user","token_user","=","user_id")
            ->where("access_token","=",$acs_token)
            ->where("openID","=",$open_id)
            ->first();
        if(empty($data))
        {
            //为空，说明没有绑定用户id此时应该直接注册一个，调用qqRegister将返回一个用户id，这时在更新一下base_token表进行绑定
            $user_data = User::qqRegister();

            $sessionInitData["user_status"] = true;
            $sessionInitData["user_id"] = $user_data['user_id'];
            $sessionInitData["user_username"] = $user_data['user_username'];
            session(["user"=>$sessionInitData]);

            $user_id = $user_data['user_id'];
            DB::table("base_token")->where("access_token","=",$acs_token)
                ->where("openID","=",$open_id)
                ->update(['token_user'=>$user_id]);
            return $user_data;
        }
        else
        {
            $sessionInitData["user_status"] = true;
            session(["user"=>$sessionInitData]);
            dump($_SESSION);
            return true;
        }
    }
    static function qqRegister()
    {
        //自动注册一个网站用户
        $data['user_username'] = "base_cms";
        $data['user_password']='';
        for($i=0;$i<6;$i++)
        {
            $data['user_password'].= rand(1, 10);
        }
        $data['user_password'] = md5($data['user_password']);
        $data['user_id'] = DB::table("base_user")->insertGetId($data);
        return $data;
    }



    public function __construct($user_id)
    {

    }
    public function logout()
    {

    }
    public function update()
    {

    }

    /*---------------end----------------------*/




    /*----------�����ݿ�ͬ�������Ϣ-------------*/
    public function syncBaseInfo()
    {

    }

    public function syncArticleInfo()
    {

    }

    public function syncSubjectInfo()
    {

    }

    public function syncImageInfo()
    {

    }

    public function syncCollectInfo()
    {

    }
    /*---------------end-------------------*/









}