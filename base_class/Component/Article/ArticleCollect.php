<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 17:51
 */

namespace BaseClass\Component\Article;


class ArticleCollect
{

   /*
    * 按照条件查询收藏
    * */
    static function select($query_limit)
    {

    }
    /*
     * 传递一个数组进入函数
     * $info_array
     * 添加成功返回一个收藏项的实例，失败false
     * */
    static function add($info_array)
    {

    }

    /*
     * 构造函数，传入一个收藏id
     * */
    public function __construct($collect_id)
    {

    }

    /*
     * 同步数据收藏的基本信息 存放到$this->info
     * */
    public function syncBaseInfo()
    {

    }

    /*
     *更新信息，传入一个更新字段数组
     * 成功返回true 失败false
     * */
    public function update($info_array)
    {

    }
    /*
     * 删除一个收藏（根据$this->info->collect_id），可选传入user_id,如果存在该字段，应该检测该收藏是不是这个用户的
     * */
    public function delete($user_id = null)
    {

    }
}