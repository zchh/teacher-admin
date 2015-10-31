<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class BaseController extends Controller {
    public function index()
    {
        $inputData['articleData'] = DB::table("base_article")->get();
        
        return view("Index.index",$inputData);
    }
    
    public function findArticle()
    {
        dump($_GET);
        
        $key = "%".$_GET["key"]."%";
        $results = DB::select('select * from base_article where article_title like :key', ['key' => $key]);
        dump($results);
        exit();
        return view("Index.Article.findArticle");
    }
    
    
    public function sArticle()
    {
        return view("Index.sArticle");
    }
    
    public function userIndex()
    {
        return view("Index.userIndex");
    }
    
    
    public function sSubject()
    {
        return view("Index.sSubject");
    }
    
    
    public function moreSubject()
    {
        return view("Index.moreSubject");
    }
    
    public function articleDetail()
    {
        return view("Index.articleDetail");
    }
}
