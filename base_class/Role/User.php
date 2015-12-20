<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 13:56
 */

namespace BaseClass\Role;
use BaseClass\Component\Article\Article;


class User
{

    private $info;
    private $article_list;
    private $subject_list;
    private $image_list;
    private $collect_list;



    /*-------------------------*/
    static function addUser($info_array)
    {
        echo "huhihi";
    }

    /**
     * @param $info_array 登陆信息数组
     * @return User
     */
    static function login($info_array)
    {

    }
    static function qqLogin($acs_token, $open_id)
    {

    }
    static function qqRegister()
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




    /*--------------------*/
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