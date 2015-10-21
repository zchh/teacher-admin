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
        $data["PowerData"]=DB::table("base_admin_power")->get();
        return view("Admin.Power.sAdminPowerGroup",$data);
    }
    public function sAdmin()
    {
        $data["PowerData"]=DB::table("base_admin")->get();
        return view("Admin.Power.sAdmin",$data);
    }
    public function aAdmin()
    {
        return view("Admin.Power.aAdmin");
    }
    public function Handle_aAdmin()
    {
        $input = Request::only('admin_username','admin_nickname', 'admin_password');
        $input["admin_password"]=md5('admin_password');
        $data = DB::table("base_admin")->insert($input);
        return redirect("Admin.Power.sAdmin");
    }
    
}
