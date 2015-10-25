<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use GirdPlugins\Base\ArticleFunc;
use GirdPlugins\Base\BaseFunc;
class ImageController extends Controller 
{
    public function sImage()
    {
        session(["nowPage"=>"/user_sImage"]);
        return view("User.Image.sImage");
    }
}