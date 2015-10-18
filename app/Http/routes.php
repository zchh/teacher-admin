<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get("/test","TestController@test");


Route::get("/admin_login","Admin\BaseController@login");
Route::get("/admin_logout","Admin\BaseController@logout");
Route::post("/_admin_login","Admin\BaseController@_login");
Route::get("/admin_index","Admin\BaseController@index");


/*
 * 管理员权限组管理功能
 * 说明：多管理员系统需要一些权限限制，这些路由依次提供 查找所有权限组，
*/
Route::get("/admin_sPowerGroup","Admin\PowerController@sPowerGroup");//查看所有的权限组
Route::post("/admin_aPowerGroup","Admin\PowerController@aPowerGroup");//添加权限组在 admin_sPowerGroup 页面的一个弹出框完成。
Route::post("/admin_dPowerGroup","Admin\PowerController@dPowerGroup");//删除权限组在 admin_sPowerGroup 页面的一个弹出框完成。

Route::get("/admin_morePowerGroup/{group_id}","Admin\PowerController@morePowerGroup");           //查看一个权限组的详情
Route::post("/admin_uPowerGroup","Admin\PowerController@uPowerGroup");                            //修改权限组信息在 admin_morePowerGroup 页面里面通过弹出框修改
Route::post("/admin_addUserToPowerGroup","Admin\PowerController@addUserToPowerGroup");           //添加用户到一个权限组,在详情页进行操作
Route::post("/admin_removeUserToPowerGroup","Admin\PowerController@removeUserToPowerGroup");     //从一个权限组移出用户，在详情页操作
Route::post("/admin_addPowerToPowerGroup","Admin\PowerController@addPowerToPowerGroup");         //添加权限到一个权限组,在详情页进行操作
Route::post("/admin_removePowerToPowerGroup","Admin\PowerController@removePowerToPowerGroup");     //从一个权限组移出权限，在详情页操作

Route::get("/admin_sAdminUser","Admin\PowerController@sAdminUser");//查看所有的管理员用户
Route::post("/admin_aAdminUser","Admin\PowerController@aAdminUser");//添加一个管理员用户
Route::post("/admin_dAdminUser","Admin\PowerController@dAdminUser");//删除某个管理员用户

Route::get("/admin_moreAdminUser","Admin\PowerController@moreAdminUser");//查看一个管理员用户的详情
Route::post("/admin_uAdminUser","Admin\PowerController@uAdminUser");//修改某个管理员用户


/*
/*
 * 用户级权限组管理功能
 * 说明： 对于各种用户有不同的权限限制，这些权限组成一个权限组，用户和权限组关联
 *  */
Route::get("/admin_sPowerGroup","Admin\PowerController@sPowerGroup");//查看所有的权限组
Route::post("/admin_aPowerGroup","Admin\PowerController@aPowerGroup");//添加权限组在 admin_sPowerGroup 页面的一个弹出框完成。
Route::post("/admin_dPowerGroup","Admin\PowerController@dPowerGroup");//删除权限组在 admin_sPowerGroup 页面的一个弹出框完成。

Route::get("/admin_morePowerGroup/{group_id}","Admin\PowerController@morePowerGroup");           //查看一个权限组的详情
Route::post("/admin_uPowerGroup","Admin\PowerController@uPowerGroup");                            //修改权限组信息在 admin_morePowerGroup 页面里面通过弹出框修改
Route::post("/admin_addUserToPowerGroup","Admin\PowerController@addUserToPowerGroup");           //添加用户到一个权限组,在详情页进行操作
Route::post("/admin_removeUserToPowerGroup","Admin\PowerController@removeUserToPowerGroup");     //从一个权限组移出用户，在详情页操作
Route::post("/admin_addPowerToPowerGroup","Admin\PowerController@addPowerToPowerGroup");         //添加权限到一个权限组,在详情页进行操作
Route::post("/admin_removePowerToPowerGroup","Admin\PowerController@removePowerToPowerGroup");     //从一个权限组移出权限，在详情页操作

Route::get("/admin_sAdminUser","Admin\PowerController@sAdminUser");//查看所有的管理员用户
Route::post("/admin_aAdminUser","Admin\PowerController@aAdminUser");//添加一个管理员用户
Route::post("/admin_dAdminUser","Admin\PowerController@dAdminUser");//删除某个管理员用户

Route::get("/admin_moreAdminUser","Admin\PowerController@moreAdminUser");//查看一个管理员用户的详情
Route::post("/admin_uAdminUser","Admin\PowerController@uAdminUser");//修改某个管理员用户




/*
 * 
 * 
 *  */