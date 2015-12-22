<?php
/**
 * Created by PhpStorm.
 * User: lzq
 * Date: 2015/12/21
 * Time: 18:15
 */

namespace BaseClass\Component\Message;
use Illuminate\Support\Facades\DB;

class Message
{
    /**
     * 添加信息
     * @access public
     * @param $info_array
     * |-message_send_user/message_send_admin  发送者（有则传值，无就置null）
     * |-message_recv_user/message_recv_admin  接收者（同理）
     * |-message_title 信息标题
     * |-message_data 信息内容
     */
    static function add($info_array)
    {
        $info_array['message_create_date']=date("Y-m-d H:i:s");
        $info_array['message_read']=0;
        if($info_array['message_recv_user'] || $info_array['message_recv_admin'])
        {
            if(true == $info_array['message_recv_user'])//接收者是用户
            {
                if(DB::table('base_user')->where('user_id','=',$info_array['message_recv_user']))
                {
                    return DB::table('base_message')->insert($info_array);
                }
                else
                {
                    return false;
                }
            }
            else if(true == $info_array['message_recv_admin'])//接收者是管理员
            {
                if(DB::table('base_admin')->where('admin_id','=',$info_array['message_recv_admin']))
                {
                    return DB::table('base_message')->insert($info_array);
                }
                else
                {
                    return false;
                }
            }
        }
        else//没有信息接收者
        {
            return false;
        }

    }

    /**
     * 信息构造
     * @param $message_id INT
     */
    public function __construct($message_id)
    {
        $this->message_id=$message_id;
    }

    /**
     * 查询信息 如没有查询限制则置$query_limit=null
     * @param $query_limit
     * |-send user/admin 发送者
     * |-desc(默认asc)
     * |-size 每页条数
     * |-search 查找关键字
     * @return $return_data
     * |-status 是否成功 true/false
     * |-message DB返回的二维结构
     * |-num  总条数
     */
    static function select($query_limit)
    {

        $query=DB::table('base_message');

        //根据发送者是用户还是管理员划分
        if(!empty($query_limit['send']))
        {
            if($query_limit['send']== 'user')
            {
                $query = $query->where('message_send_admin','=',null);
            }
            else
            {
                $query = $query->where('message_send_user','=',null);
            }
        }

        //排序
        if(!empty($query_limit['desc']))
        {
            $query = $query->orderBy("message_id",'desc');
        }
        else
        {
            $query = $query->orderBy("message_id");
        }

        //关键字
        if (!empty($query_limit["search"])  )
        {
            $query = $query->where("message_title","like","%".$query_limit["search"]."%");
        }

        //总条数
        $num_query  = clone $query;//克隆出来不适用原来的对象
        $return_data["num"] = $num_query->select(DB::raw('count(*) as num'))->first()->num  ;

        //每页条数
        if(!empty($query_limit['size']))
        {
            $query = $query->take($query_limit['size']);
        }

        $return_data['status'] = true;
        $return_data['message'] = $query->get();
        return $return_data;
    }

    /**
     * 删除信息
     * @return bool
     */
    public function delete()
    {
        return DB::table('base_message')
            ->where('message_id','=',$this->message_id)
            ->delete();
    }
}