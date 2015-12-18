<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 13:56
 */

namespace BaseClass\Role;


class User
{

    private $info;
    private $article_list;
    private $subject_list;
    private $image_list;
    private $collect_list;



    /*----------------基本操作函数--------------*/
    static function addUser($info_array)
    {
        echo "创建用户";
    }
    static function login($info_array)
    {

    }




    public function __construct($user_id)
    {

    }
    public function logout()
    {

    }
    public function update()
    {

    }

    /*---------------end----------------------*/




    /*----------从数据库同步相关信息-------------*/
    public function syncBaseInfo()
    {

    }

    public function syncArticleInfo()
    {

    }

    public function syncSubjectInfo()
    {

    }

    public function syncImageInfo()
    {

    }

    public function syncCollectInfo()
    {

    }
    /*---------------end-------------------*/









}