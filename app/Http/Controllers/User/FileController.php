<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\BaseFunc;


class FileController extends Controller 
{
    public function sFile()
    {
        session(["nowPage"=>"/user_sFile"]);
        return view("User.File.sFile");
    }
    public function aFile()
    {
        Request::only("");
    }
    
    
    
    /*
    public function test()
    {
        return view("User.File.test");
    }
    */
    
}
?>