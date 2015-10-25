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
        return view("Index.index");
    }
}
