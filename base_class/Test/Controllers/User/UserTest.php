<?php
namespace BaseClass\Test\Controllers\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use BaseClass\Role\User;


class UserTest extends Controller
{
    public function addUser()
    {
        $user_array=array('user_username'=>'gggggg','user_password'=>md5(123),'user_nickname'=>'草上走','user_sex'=>'男',
                            'user_age'=>'18','user_intro'=>'','user_email'=>'');
        $a = User ::addUser($user_array);
        dump($a);
    }

    public function loginUser()
    {
        $user_array= array('user_username'=>'cccc','user_password'=>'123');
        $a =User::login($user_array);
        dump($a);
    }

    public function constructUser()
    {
        $a = new User(2);
        dump($a);

    }

    public function logoutUser()
    {
        $a = new User(1);
        dump($a);
       $b= $a->logout();
        dump($b);

    }

    public function updateUser()
    {
        $user_array=array('user_username'=>'13310520','user_password'=>md5(123),'user_nickname'=>'chaochaochao','user_sex'=>'女',
            'user_age'=>'18','user_intro'=>NULL,'user_email'=>'243136234@qq.com','user_image'=>NULL);
       $a=new User(31);
        $a->update($user_array);
        dump($a);
    }

}