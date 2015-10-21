<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use GirdPlugins\Base\BaseFunc;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class PowerController extends Controller {
    public function sAdminPowerGroup()
    {
        return view("Admin.Power.sAdminPowerGroup");
    }
    public function sAdmin()
    {
        
    }
}
