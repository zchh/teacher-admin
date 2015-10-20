<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class ArticleController extends Controller {
    public function te(BaseFunc $base)
    {
       
       $input_data["ajax_request"] = $base->requestAjax(["admin_username","admin_password"], "123", "/_admin_te");
       return view("Admin.Article.te",$input_data);
       
    }
    public function _te(BaseFunc $base)
    {
        $data = $base->responseAjax("正确", "你通过了", "<a href='/admin_index' class='btn btn-default'>跳船</a>");
        return $data;
        
    }
    public function sArticle()
    {
        
    }
}
