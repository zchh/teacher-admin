<?php

namespace GirdPlugins\Base;

use \Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
class BaseFunc {

    public function __construct() {
        
    }



    /**
     * 在提交接收页面以后，将错误/正确提示信息保存于session，并在下一页面调用showRedirectMessage()将信息显示在指定位置  
     * @access public
     * @param bool $status  正确/错误
     * @param string $message 提示信息  
     * @param string $plugin  需要额外加入的页面组件，如链接按钮等，显示在信息框底部
     * @param string $redirect  如果需要顺便跳转到某个页面，可以将其url填入，如果为空，则忽略不跳转
     * @return NULL/直接跳转
     */
    public function setRedirectMessage($status, $message, $plugin=NULL, $redirect = NULL) {
         if (Request::ajax()) 
        {//如果是ajax请求
            //
              return response()->json(['status' => $status, 'message' => $message,"plugin" => $plugin]);
        } else 
        {
            Session::put("__Ajax_RedirectFunc_have", true);
            Session::flash('__Ajax_RedirectFunc_status', $status);
            Session::flash('__Ajax_RedirectFunc_message', $message);
            Session::flash('__Ajax_RedirectFunc_plugin', $plugin);
            if ($redirect !== NULL) {
                echo
                '<script language="javascript" type="text/javascript">
                window.location.href="' . $redirect . '";
                </script> ';
            }
            return NULL;
        }
    }
    
    /**
     * 管理员用户登陆检查
     * 
     * 
     * @access public
     * @param string $user_name 用户名
     * @param string $password 密码
     *
     * @return 若成功，返回用户信息，失败返回false；
     */
    public function loginAdminCheck($user_name, $password) {
        $userData = DB::table("base_admin")
                ->where("admin_username", "=", $user_name)
                ->where("admin_password", "=", md5($password))
                ->first();
        if ($userData != NULL) {
            return $userData;
        } else {
            return false;
        }
    }


     /**
     * 用户登陆检查
     * 
     * 
     * @access public
     * @param string $user_name 用户名
     * @param string $password 密码
     *
     * @return 若成功，返回用户信息，失败返回false；
     */
    public function loginUserCheck($user_name, $password) {
        $userData = DB::table("base_user")
                ->where("user_username", "=", $user_name)
                ->where("user_password", "=", md5($password))
                ->first();
        if ($userData != NULL) {
            return $userData;
        } else {
            return false;
        }
    }
    

    /**
     * 获取当前登录用户关注过的所有用户的文章（用户主页）
     * 
     * 
     * @access public
     * @param string $user_id 用户id
     *
     * @return 被关注用户的所有文章数据
     */
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


}
