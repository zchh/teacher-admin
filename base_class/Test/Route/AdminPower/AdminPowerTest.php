<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 20:30
 */
$__BasePrefix = "BaseClass\\Test\\Controllers\\Admin\\";
//Route::get("test_articleTest",$__BasePrefix."ArticleTest@test");

Route::get("test2_addTest",$__BasePrefix."AdminPowerTest@addTest");
Route::get("test2_addPower",$__BasePrefix."AdminPowerTest@addPowerTest");
Route::get("test2_removePowerTest",$__BasePrefix."AdminPowerTest@removePowerTest");
Route::get("test2_addPowerTest",$__BasePrefix."AdminPowerTest@addAdminTest");
Route::get("test2_removerAdminTest",$__BasePrefix."AdminPowerTest@removeAdminTest");
Route::get("test2_addAdminTest",$__BasePrefix."AdminPowerTest@addAdminTest");
Route::get("test2_deleteTest",$__BasePrefix."AdminPowerTest@deleteTest");

Route::get("test2_getAdminPower",$__BasePrefix."AdminPowerTest@getAdminPower");
