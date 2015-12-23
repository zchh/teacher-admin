<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 15:52
 */

namespace BaseClass\Component\Article;


class ArticleReply
{
    public $info;

    /**
     * 查询 select
     */
    public function select()
    {

    }

    //传入reply_id 实例化一条评论的对象
    public function __construct($reply_id)
    {

    }

    //传入一个数组，添加一条评论
    /**
     * @param $info_array
     * |-parent   评论的父级 如果是文章的第一层评论，那么插入时不需要有relation_parent属性，（是不需要，不是null）
     * |-article  评论的依赖文章
     * |-user     评论的用户
     * |-detail   评论详情
     * |-
     */
    static function addReply( $info_array)
    {

    }

    //同步信息
    public function syncBaseInfo()
    {

    }

    //评论删除
    public function delete()
    {

    }



}

/*这个函数是构造一个评论树*/
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
    public function __construct($limit_info)
    {

    }


    /**
     * 根据当前文章条件构造树
     * 返回一个准备好的评论树视图
     * view("BaseClass::replyTree",$inputData);
     * */
    public function buildArticleReplyTree()
    {

    }

    /**
     * 构造评论树
     */
    public function  &buildReplyTree()
    {

    }



}


/**
 *
 * 参考
 * 调用实例请见Controllers/Index/BaseController 里面的 articleDetail
 * 调用的了原来的基类来自 gird_plugins/Base/class/ArticleFunc底部
 * 这个函数加载了包自己的视图位于ird_plugins/Base/views/reply（构造的基本图形界面） 和 areply（作为添加评论的窗口）
 *
 *
 * 我已经拷贝这两个视图的代码到新的base_class/views/ 低下
 * 你可以调用这两个视图 类似于 view("BaseClass::replyTree",$inputData);
 * 不懂请问彭亮  他做过这一块
 *
*
 * 获取一篇文章的评论
 * @access public
 * @param string $articleId  获取的文章ID
 *
 *
 * @return html 界面
 *
public function getArticleReply($articleId)
{
    $replyData = DB::table("base_article_reply")->where("reply_article","=",$articleId)

        ->join("base_reply_relation","relation_child","=","reply_id")
        ->join("base_user","reply_user","=","user_id")
        //->join("base_image","user_image","=","image_id")
        ->get();//先查出该文章的所有节点和关系


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
        $gui.=view("Base::reply",$inputData);

    }


    $inputData["article_id"] = $articleId;
    $gui.=view("Base::aReply",$inputData);

    return $gui;


}

private function &buildReplyTree($parent, &$replyData)
{
    $gui="";
    foreach($replyData as $key=>$data)
    {
        if($data->relation_parent == $parent )
        {
            $inputData["reply_data"] = $data;
            $inputData["son"] = & $this -> buildReplyTree($data->reply_id, $replyData);
            $gui.=view("Base::reply",$inputData);
            unset($replyData[$key]);
        }
    }

    return $gui;

}


}

*/