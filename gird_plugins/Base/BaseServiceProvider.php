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
        include __DIR__.'\class\BaseFunc.php';      //基础函数
        include __DIR__.'\class\LogFunc.php';       //记录函数  
        include __DIR__.'\class\ArticleFunc.php';   //文章函数
        include __DIR__.'\class\ImageFunc.php';     //图片媒体函数
        include __DIR__.'\class\AdminPowerFunc.php';//管理员去哪弦函数
        include __DIR__.'\class\UserPowerFunc.php'; //用户权限函数
        include __DIR__.'\class\PageDivide.php';    //分页函数
        include __DIR__.'\class\MailFunc.php';      //邮件函数
        include __DIR__.'\class\SecureFunc.php';    //安全函数
        
    }
    

    /**
     * 在容器中注册绑定。
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("Base",function(){
            //return new test();
        });
    }

}