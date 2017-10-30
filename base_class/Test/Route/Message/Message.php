<?php
/**
 * Created by PhpStorm.
 * User: lzq
 * Date: 2015/12/22
 * Time: 10:55
 */

$__BasePrefix = "BaseClass\\Test\\Controllers\\Message\\";
Route::get("test_messageAddTest",$__BasePrefix."MessageTest@addTest");
Route::get("test_messageDeleteTest",$__BasePrefix."MessageTest@deleteTest");
Route::get("test_messageSelectTest",$__BasePrefix."MessageTest@selectTest");