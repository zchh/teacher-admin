<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/21
 * Time: 18:15
 */

namespace BaseClass\Component\Message;


class Message
{
    //添加信息
    /*
     * 如果发送者不是user  或者 admin，则把send_user/send_admin设置为空 ，recv_admin,recv_user同理
     *
     * */
    static function add($send_user,$send_admin,$recv_user,$recv_admin)
    {

    }


    //信息构造

    public function __construct($message_id)
    {

    }

    /*根据筛选条件$query_info 来判定查询的条目
        请参考 Article的 select
     * */
    public function select($query_info)
    {

    }

    public function delete()
    {

    }
}