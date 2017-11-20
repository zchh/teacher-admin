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
   protected function getPic($id){
       ob_end_clean();
       Pic::getPicById($id);
   }

    //alert弹出框
    protected function alert($message = '', $return_url = null, $isLeftMenu = false)
    {
        if (is_null($return_url) && $isLeftMenu == false) {
            $return_url = '/';
            if (isset ($_SERVER ['HTTP_REFERER'])) {
                $return_url = $_SERVER ['HTTP_REFERER'];
            }
            $html = '<script>' . (empty($message) ? '' : 'alert("' . $message . '");') .'location.href="' . $return_url . '";</script>'; //内联框架内跳转
        } else{
            if(is_null($return_url)){
                if (isset ($_SERVER ['HTTP_REFERER'])) {
                    $return_url = $_SERVER ['HTTP_REFERER'];
                }
            }
            $html = '<script>' . (empty($message) ? '' : 'alert("' . $message . '");') . 'window.parent.window.location.href ="' . $return_url . '";</script>'; //跳出内联框架
        }
        header('Content-Type: text/html; charset=utf-8');
        die ($html);
    }
}
