<?php namespace GirdPlugins\Base;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class BaseServiceProvider extends ServiceProvider {
    
    

    /**
     * 执行注册后的启动服务。
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__."/views" , 'Base');
        //require __DIR__ . '/../vendor/autoload.php';
        //include __DIR__."router.php";
        //Route::get("/test_1",  "App\Http\Controllers\TestController@test");
        include __DIR__.'\class\BaseFunc.php';
        include __DIR__.'\class\PowerFunc.php';
        include __DIR__.'\class\LogFunc.php';
        include __DIR__.'\class\ArticleFunc.php';
        include __DIR__.'\class\ImageFunc.php';
        
    }
    

    /**
     * 在容器中注册绑定。
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("Base",function(){
            return new test();
        });
    }

}