<?php


$__BasePrefix = "BaseClass\\Test\\Controllers\\User\\";
//Route::get("test_articleTest",$__BasePrefix."ArticleTest@test");

Route::get("test_addUser",$__BasePrefix."UserTest@addUser");
Route::get("test_loginUser",$__BasePrefix."UserTest@loginUser");
Route::get("test_constructUser",$__BasePrefix."UserTest@constructUser");
Route::get("test_logoutUser",$__BasePrefix."UserTest@logoutUser");
Route::get("test_updateUser",$__BasePrefix."UserTest@updateUser");