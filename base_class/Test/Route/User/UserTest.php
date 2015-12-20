<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 2015/12/17
 * Time: 9:41
 */
$__BasePrefix = "BaseClass\\Test\\Controllers\\User\\";
//Route::get("test_articleTest",$__BasePrefix."ArticleTest@test");


Route::get("test_addUserTest",$__BasePrefix."UserTest@addUserTest");
Route::get("test_updateTest",$__BasePrefix."UserTest@updateTest");
Route::get("test_loginTest",$__BasePrefix."UserTest@loginTest");