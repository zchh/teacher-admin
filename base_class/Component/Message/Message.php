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
     * 如果发送者不是user 或者 admin，则把message_send_user/message_send_admin设置为空,
     * message_recv_admin,message_recv_user同理
     * message_title,message_date 信息标题,内容
     */
    static function add($info_array)
    {
        $info_array['message_create_date']=date("Y-m-d H:i:s");
        $info_array['message_read']=0;
        return DB::table('base_message')
            ->insert($info_array);
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
     * 查询信息
     * @param $query_limit
     * |-send user/admin
     * |-desc(默认asc)
     * @return $return_data
     * |-status 是否成功 true/false
     * |-message DB返回的二维结构
     * |-num  总条数
     */
    public function select($query_limit)
    {

        $query=DB::table('base_message');

        if(!empty($query_limit['send']))//根据发送者是用户还是管理员划分
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

        if(!empty($query_limit['desc']))//排序
        {
            $query = $query->orderBy("message_id",'desc');
        }
        else
        {
            $query = $query->orderBy("message_id");
        }

        $num_query  = clone $query;//克隆出来不适用原来的对象
        $return_data["num"] = $num_query->select(DB::raw('count(*) as num'))->first()->num  ;

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