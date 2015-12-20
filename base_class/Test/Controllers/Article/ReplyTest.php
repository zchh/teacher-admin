<?php
/**
 * Created by PhpStorm.
 * User: Silence
 * Date: 2015/12/5
 * Time: 11:18
 */

namespace BaseClass\Test\Controllers\Article;
use Illuminate\Support\Facades\DB;

use Illuminate\Routing\Controller;

class ReplyTest extends Controller
{

    public function sReply()
    {

        $data['replyData'] = DB::table("base_article_reply")
            ->leftJoin("base_article","reply_article","=","article_id")
            ->leftJoin("base_user","article_id","=","user_id")
            ->get();
            //->orderBy("reply_create_date","desc")
            //->paginate(10);

    }

    public function aReply()
    {
        //$inputData = Request::only("reply_article","reply_detail");
        $inputData["reply_create_date"] = date('Y-m-d H:i:s');
        $inputData["reply_user"] = 1;
        $inputData["reply_article"] = 1;
        $inputData["reply_detail"] = "哇塞！王总好帅~";
        $return_id = DB::table("base_article_reply")->insertGetId($inputData);
        $relationData["relation_parent"] = 9;
        $relationData["relation_child"] = $return_id;
        DB::table("base_reply_relation")->insert($relationData);
        dump($inputData);
        dump($relationData);
    }


}