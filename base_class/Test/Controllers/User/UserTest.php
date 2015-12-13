<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 2015/12/13
 * Time: 17:07
 */

namespace BaseClass\Test\Controllers\User;
use BaseClass\Role\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class UserTest extends Controller
{
  public function addUserTest()
  {
     $info_array["user_username"]=1;
     $info_array["user_password"]=1;
     $info_array["user_nickname"]=1;
     $info_array["user_ture"]=1;
     $info_array["user_sex"]=1;
     $info_array["user_email"]=1;
     $info_array["user_creat_date"]=1;
     $info_array["user_update_date"]=1;

      $a = User::addUser($info_array);
      dump($a);


  }


}