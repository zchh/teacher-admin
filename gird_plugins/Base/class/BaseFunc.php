<?php

namespace GirdPlugins\Base;

use \Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
class BaseFunc {

    public function __construct() {
        
    }

    /*     * 放弃使用！！！
     * 重定向后显示提示信息和按钮
     * @access public
     * @return HTML代码 显示提示信息的html代码，打印在视图中
     * 
     * 在本次项目中已经添加到base.blade.php中，你只需要调用setRedirectMessage设置信息即可
     */

    public function showRedirectMessage() {
        if (Session::get("__Ajax_RedirectFunc_have") != true) {
            return NULL;
        }
        Session::put("__Ajax_RedirectFunc_have", false);
        $input_data["status"] = Session::get('__Ajax_RedirectFunc_status');
        $input_data["message"] = Session::get('__Ajax_RedirectFunc_message');
        $input_data["plugin"] = Session::get('__Ajax_RedirectFunc_plugin');
        return view("Base::showRedirectMessage", $input_data);
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
    public function setRedirectMessage($status, $message, $plugin, $redirect = NULL) {
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
     * 放弃使用！！！！！
     * 为表单的ajax提交提供快速方法和返回响应模态框，在接收函数中需要与responseAjax搭配
     * 注意，本函数可以自动识别单选，多选，多选存在数组中，
     * 对于单选框，只需要输入首行id,以name区别字段，值提取value中的
     * 对于复选框，需要输入首行id,以name区别字段，值提取value中的
     * 
     * @access public
     * @param array $data_id_array 需要提交的输入框的id值数组
     * @param string $submit_id  提交按钮id
     * @param string $recv  接收数据页面url地址
     * @param bool $debug=false  是否开启调试
     * @return HTML代码  包含了ajax请求的js和响应模态框，把这个代码打印在视图中
     */
    public function requestAjax(array $data_id_array, $submit_id, $recv, $debug = false) {
        $input_data["data_id_array"] = $data_id_array;
        $input_data["submit_id"] = $submit_id;
        $input_data["recv"] = $recv;
        $input_data["debug"] = $debug;


        return view("Base::requestAjax", $input_data);


        /*

         * 
         * 在界面里面有四个可填写信息选项与requestAjax结合返回响应的数据
         * __recv_title ： 模态框标题
         * __recv_message ：模态框详情，允许html代码写入
         * __recv_plugin ：低栏按钮和链接，允许html代码写入
         * 模态框名
         * __Ajax_BaseFunc_recv
         * 请注意不要重名
         *          */
    }

    /**
     * 在接受页面返回一个ajax请求，符合requestAjax模态框的打印格式，与responseAjax搭配
     * 示范:
     *   return $BaseFunObj->responseAjax(true, "完成", "请注意收尾", NULL);
     * 
     * @access public
     * @param string $title 模态框标题
     * @param string $message 模态框详细信息，可以填入html代码构建复杂功能
     * @param string $footer 模态框低栏按钮，可以填入html代码构建复杂功能
     * @return json，调用者接收到以后return该数据即可
     */
    public function responseAjax($title, $message, $footer) {

        $response["title"] = $title;
        $response["message"] = $message;
        $response["plugin"] = $footer;

        return response()->json($response);
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
        
        $data = DB::table("base_article")->join("base_user_relation","relation_focus","=","article_user")
                ->join("base_user","user_id","=","article_user")
                ->where("relation_user","=",$user_id)->orderBy("article_id","desc")
                ->simplePaginate(10);
        return $data;
        
        /*;
        //根据传过来的user_id查询他所关注过的用户
        $attentioned_data = DB::table("base_user_relation")->where("relation_user","=",$user_id)->get();
        //获取所有的被关注用户的relation_focus
        $relation_focus_ids = array();
        foreach ($attentioned_data as $key => $value) 
        {
            $relation_focus_ids[] = $value->relation_focus;
        }
        $article_data = [];
        //开始查询文章
        foreach ($relation_focus_ids as $key => $value)
        {
            $article_data[] = DB::table("base_article")->Join("base_user","article_user","=","user_id")
                    ->where("article_user","=",$value)
                    ->get();
        }
        return $article_data;
         * 
         */
    }

    
   
    
 


   

}
