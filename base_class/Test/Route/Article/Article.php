
<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 16:26
 */
$__BasePrefix = "BaseClass\\Test\\Controllers\\Article\\";
Route::get("test_getMoreByUserTest",$__BasePrefix."ArticleTest@getMoreByUserTest");
Route::get("test_getMoreBySubjectTest",$__BasePrefix."ArticleTest@getMoreBySubjectTest");
Route::get("test_addTest",$__BasePrefix."ArticleTest@addTest");
Route::get("test_syncBaseInfoTest",$__BasePrefix."ArticleTest@syncBaseInfoTest");
Route::get("test_syncReplyInfoTest",$__BasePrefix."ArticleTest@syncReplyInfoTest");
Route::get("test_updateTest",$__BasePrefix."ArticleTest@updateTest");
Route::get("test_deleteTest",$__BasePrefix."ArticleTest@deleteTest");