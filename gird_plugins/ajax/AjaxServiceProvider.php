<?php namespace GirdPlugins\Ajax;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AjaxServiceProvider extends ServiceProvider {
    
    

    /**
     * 执行注册后的启动服务。
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__."/views" , 'Ajax');
        //require __DIR__ . '/../vendor/autoload.php';
        //include __DIR__."router.php";
        //Route::get("/test_1",  "App\Http\Controllers\TestController@test");
        include __DIR__.'\class\BaseFunc.php';
        
    }
    

    /**
     * 在容器中注册绑定。
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("Ajax",function(){
            return new test();
        });
    }

}