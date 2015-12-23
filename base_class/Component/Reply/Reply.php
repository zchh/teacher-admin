<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2015/12/23
 * Time: 9:28
 */
namespace BaseClass\Component\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class Reply
{
    private $reply_id;
    public $info;

    public function __construct($reply_id)
    {
        $this->reply_id=$reply_id;
        $this -> syncBaseInfo();
    }
    public function syncBaseInfo()
    {
     $replyId = $this -> reply_id;
        $first =  DB::table('base_article_reply')-> where("reply_id","=",$replyId) ->first();
        if($first == null)
        {
            return false;
        }
        else
        {
            $this ->info = $first;
            return true;
        }

    }

}