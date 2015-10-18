<?php namespace App\Http\Controllers;
use GirdPlugins\Ajax\BaseFunc;
use Illuminate\Support\Facades\Request;
class TestController extends Controller {
    public function test(BaseFunc $a)
    {
        //dump(session("dump"));
        $message = $a->showRedirectMessage();
        $input_data["showRedirectMessage"] = $message;
        $input_data["requestAjax"] = $a->requestAjax(["1_","2_","3_","4_","5_"], "submit_id", "test_post",true);
        return view("base",$input_data);
    }
    public function test_post(BaseFunc $a)
    {   //dump($_SESSION["dump"]);
       //$a->setRedirectMessage(false,"请检查你的数据",NULL,$redirect="/test");
        $me=" this is data: ";
        $m = Request::all();
        foreach($m as $key => $data)
        {
             $me.=" <br/> ";
            $me.= $key ;
            $me.=" : ";
            if(is_array($data))
            {
                $me.="数组";
            }
            else
            {
                $me.= $data; 
            }
            
        }
        dump($m);
        $s = $a->responseAjax("完 成",$me,"sasa");
        return $s;

    }
    public function test_re_post()
    {
        return view("re_post");
    }
    public function Admin()
}
