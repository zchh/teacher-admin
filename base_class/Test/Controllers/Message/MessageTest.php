<?php
/**
 * Created by PhpStorm.
 * User: lzq
 * Date: 2015/12/22
 * Time: 10:45
 */

namespace BaseClass\Test\Controllers\Message;
use App\Http\Controllers\Controller;
use BaseClass\Component\Message\Message;

class MessageTest extends Controller
{
    public function addTest()
    {
        $info_array['message_send_user']=21;
        $info_array['message_send_admin']=null;
        $info_array['message_recv_user']=null;
        $info_array['message_recv_admin']=2;
        $info_array['message_title']="123";
        $info_array['message_data']="hellohellohelllooooooooo";

        dump(Message::add($info_array));
        echo 'hello';
    }
    public function deleteTest()
    {
        $message= new Message(18);
        $message->delete();
        echo 'ok';
    }

    public function selectTest()
    {
        $query_limit['send']='admin';
        $query_limit['desc']=1;
        //$query_limit['search']='几';
        $query_limit['size']=5;
        $data = Message::select($query_limit);
        dump($data);
    }
}