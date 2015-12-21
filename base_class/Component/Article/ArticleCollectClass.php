<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 17:52
 */

namespace BaseClass\Component\Article;


class ArticleCollectClass
{
    public $info;
    public $collect_list;
    //添加一个收藏夹
    static function add($info_array)
    {

    }
    //按照用户获取所有的收藏夹
    static function getMoreByUser($user_id)
    {

    }
    //传入id构造
    public function __construct($collect_id)
    {

    }
    //同步基本信息 和 在当前搜藏夹的信息，保存在$this->info 和$this->collect_list
    public function syncBaseInfo(){}

    //更新信息
    public function update($info_list)
    {

    }

    //删除  ，user_id 可选，如果传入，要检查是否是这个用户的
    public function delete()
    {

    }
}