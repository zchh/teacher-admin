<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\ArticleFunc;
class ClassController extends Controller 
{

     public function sClass()
    {
         
        
         $user = session("user");
         dump(session("user.user_id"));
          dump($user["user_id"]);
         exit();
          $combine["userArticleClass"] = DB::table('base_article_class')    //为了获得作者，要合并两张表
          ->join('base_user', 'base_article_class.class_user', '=', 'base_user.user_id')
          ->get();
          dump($combine);       
          //$inputData["userArticleClass"]= DB::table('base_article_class')->get();
          //dump($userArticleClass);
         return view("User.Article.sClass",$combine);
    }
   
    
    
}



    

    



