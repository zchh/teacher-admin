<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 2015/12/8
 * Time: 21:08
 */
$__BasePrefix = "BaseClass\\Test\\Controllers\\User\\";
//Route::get("test_articleTest",$__BasePrefix."ArticleTest@test");

Route::get("test_addTest",$__BasePrefix."UserTest@addTest");
Route::get("test_addPower",$__BasePrefix."UserTest@addPowerTest");
Route::get("test_removePowerTest",$__BasePrefix."UserTest@removePowerTest");
Route::get("test_addUserTest",$__BasePrefix."UserTest@addUserTest");
Route::get("test_removerUserTest",$__BasePrefix."UserTest@removerUserTest");
Route::get("test_deleteTest",$__BasePrefix."UserTest@deleteTest");