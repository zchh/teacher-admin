<?php
namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
use BaseClass\Role\Admin;
use BaseClass\Teacher\Pic;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GirdPlugins\Base\AdminPowerFunc;

class BaseController extends Controller {
   public function getPic($id){
       ob_end_clean();
       Pic::getPicById($id);
   }
}
