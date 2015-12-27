<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2015/12/27
 * Time: 13:59
 */

namespace BaseClass\Component\Article;
use Illuminate\Support\Facades\DB;

class ArticleReplyTree
{
    /**
     * 使用构造函数要传入各种条件，来构造成指定的评论树
     * @param $limit_info
     * |-article    根据某一篇文章的评论来生成树
     * |-           待定
     * |-
     *
     * 构造函数不构造  交给子函数做
     */

    private $article_id;

    public $replyData;

    public function __construct($limit_info)
    {
        /* $limit
      * |-article_id   按照文章id筛选
      * |-join_relation 是否和base_rely_relation表合并
      * |-join_user   是否和base_user表合并
        */
        $query = DB::table("base_article_reply");

        //reply_article查询
        if(isset($limit_info["article_id"]))   //传入build ,,,,的article_id在这了
        {
            $this -> article_id = $limit_info["article_id"];
            $query = $query -> where("reply_article","=",$limit_info["article_id"]);
        }

        //合并base_rely_relation表
        if(isset($limit_info["join_relation"]) && $limit_info["join_relation"] == true)
        {
            $query = $query -> join("base_reply_relation","relation_child","=","reply_id");
        }
        //合并base_user表
        if(isset($limit_info["join_user"]) && $limit_info["join_user"] == true)
        {
            $query = $query -> join("base_user","reply_user","=","user_id");
        }

        $replyData = $query -> get();
        $this -> replyData = $replyData;


    }


    /**
     * 根据当前文章条件构造树
     * 返回一个准备好的评论树视图
     * view("BaseClass::replyTree",$inputData);
     * */
    public function buildArticleReplyTree()
    {
        $replyData = $this -> replyData;
        $rootReply=[];
        foreach($replyData as $key => $data)
        {
            if($data->relation_parent == NULL)
            {
                $rootReply[] =$data;
                unset($replyData[$key]);

            }

        }

        $gui="";
        foreach($rootReply as $data)
        {
            //$gui .= "<div class='col-sm-12 well'>";//界面html代码
            $inputData["reply_data"] = $data;
            $inputData["son"] = &$this->buildReplyTree($data->reply_id, $replyData);
            $gui.=view("BaseClass::replyTree",$inputData);

        }

        $inputData["article_id"] = $this ->article_id;  //zc
        $gui.=view("BaseClass::aReplyGui",$inputData);

        return $gui;
    }

    /**
     * 构造评论树
     */
    private function &buildReplyTree($parent, &$replyData)
    {
        $gui="";
        foreach($replyData as $key=>$data)
        {
            if($data->relation_parent == $parent )
            {
                $inputData["reply_data"] = $data;
                $inputData["son"] = & $this -> buildReplyTree($data->reply_id, $replyData);
                $gui.=view("BaseClass::replyTree",$inputData);
                unset($replyData[$key]);
            }
        }

        return $gui;

    }




}


