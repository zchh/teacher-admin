## Base Cms 简介

本项目作为团队合作的练习，代码为一些常用应用的基础部件，可以在日后商业项目中复用。

## 文档

文档请见内部Document文件夹

## 初始化
获得文件以后，可在Document文件夹中找到数据库图文件和init.sql文件，前者用来生成数据库，后者用来初始化一些关键数据。

## 基本注意事项
1.若需要修改数据库请提前报告，并注意保存修改的sql
2.每一位开发者大多数时候只需要在几个文件内编写代码，无需必要请不要动其他开发者的代码，你动了我也会给你down掉。
3.所有需要数据库和复杂逻辑的动作请在扩展函数包中写入，方便代码复用和测试。

## 命名规范
类名，控制器，模块首字母大写，如：
classKillPeople
{
    
}

函数名，变量名请使用驼峰法，如：
function addUserToDatabase();
returnData = [];

路由名称:
想给一个例子
Router::get("/admin_sUserPowerGroup","Admin\PowerController@sUserPowerGroup");
Router::get("/模块_函数名","模块\控制器@函数名");

    在访问路径中使用驼峰命名，如admin只需要admin_函数名，若模块叫normal user 那么就为normalUser_函数名 

    其中约定几个简写select(s),update(u),delete(d),add(a)来标识一些常用操作

    如果要访问一个路由，请使用/xxxxx的绝对路径，避免路由带来的调试测试困难

    请尽量详细描述该路由的功能，即使它很长

    一个页面应该隔开一行，一组功能应该靠近，如：
        Route::get("/admin_sUser","Admin\PowerController@sUser");//查看所有的用户
        Route::post("/admin_aUser","Admin\PowerController@aUser");//添加一个用户
        Route::post("/admin_dUser","Admin\PowerController@dUser");//删除某个用户
    因为上面的页面可以进行两个操作：添加，删除，这两个功能只是在服务器处理并不需要页面，所以归为一组，不用空行断开

##扩展包开发说明
我们把所有主要的自写函数库类库全部放在/gird_pluginse中，目前主要开发Base包
1.所有和数据库相关的逻辑，比如增删改查，请写到扩展包里面
2.比较复杂的操作逻辑，也写到扩展包里面
在扩展包中，./class中是类库，请按照给出的几个类库而定例子来写。
./view是一些基础的视图代码，因为有些功能需要提供一些界面，这些代码存储在这。



##注释与文档写法：
我知道大家都不想写文档，但是注释还是要写的！
这里给出一个示范
对于扩展包中的函数，请使用phpdoc规范的注释方法，一般的控制器方法，请简单的说明即可。
/**
* 在提交接收页面以后，将错误/正确提示信息保存于session，并在下一页面调用showRedirectMessage()将信息显示在指定位置
* @access public
* @param bool $status  正确/错误
* @param string $message 提示信息  
* @param string $plugin  需要额外加入的页面组件，如链接按钮等，显示在信息框底部
* @param string $redirect  如果需要顺便跳转到某个页面，可以将其url填入，如果为空，则忽略不跳转
* @return NULL/直接跳转
*/
public function setRedirectMessage($status,$message,$plugin,$redirect=NULL)
{
    //函数
}


