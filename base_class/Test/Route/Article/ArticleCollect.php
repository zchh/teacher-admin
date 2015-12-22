<?php
/**
 * Created by PhpStorm.
 * User: yanghe
 * Date: 2015/12/21
 * Time: 20:53
 */
$__BasePrefix = "BaseClass\\Test\\Controllers\\Article\\";

Route::get("test_CollectAdd",$__BasePrefix."ArticleCollectTest@addTest");
Route::get("test_CollectSyncBaseInfo",$__BasePrefix."ArticleCollectTest@syncBaseInfoTest");
Route::get("test_CollectUpdate",$__BasePrefix."ArticleCollectTest@updateTest");
Route::get("test_CollectDelete",$__BasePrefix."ArticleCollectTest@deleteTest");