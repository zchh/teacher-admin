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
     $info_array["user_username"]=111;
     $info_array["user_password"]=123;
     $info_array["user_nickname"]=111;
     $info_array["user_true"]=1;
     $info_array["user_sex"]=1;
     $info_array["user_email"]=1;


      $a = User::addUser($info_array);
      dump($a);


  }
    public function updateTest()
    {


        $info_array["user_username"]=222;
        $info_array["user_password"]=234;
        $info_array["user_nickname"]=222;
        $info_array["user_true"]=null;
        $info_array["user_sex"]=2;
        $info_array["user_email"]=2;


        $a=new user(21);
        $a->update($info_array);

        $b=DB::table("base_user")
            ->where("user_id","=",21)
            ->get();
        dump($b);
    }
    public function loginTest()
    {
        $info_array["user_username"]=222;
        $info_array["user_password"]=234;
        $a=new user(21);
        $a->login($info_array);


    }


}