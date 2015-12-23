<?php
/**
 * Created by PhpStorm.
 * User: yanghe
 * Date: 2015/12/21
 * Time: 22:18
 */
$__BasePrefix = "BaseClass\\Test\\Controllers\\Article\\";
Route::get("test_CollectClassAdd",$__BasePrefix."ArticleCollectClassTest@addTest");
Route::get("test_CollectClassGetMoreByUserTest",$__BasePrefix."ArticleCollectClassTest@getMoreByUserTest");
Route::get("test_CollectClassSyncBaseInfoTest",$__BasePrefix."ArticleCollectClassTest@syncBaseInfoTest");
Route::get("test_CollectClassUpdateTest",$__BasePrefix."ArticleCollectClassTest@updateTest");
Route::get("test_CollectClassDeleteTest",$__BasePrefix."ArticleCollectClassTest@deleteTest");
Route::get("test_CollectClassSyncArticleTest",$__BasePrefix."ArticleCollectClassTest@syncArticleInfoTest");