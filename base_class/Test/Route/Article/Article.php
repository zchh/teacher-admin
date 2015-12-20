
<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 16:26
 */
$__BasePrefix = "BaseClass\\Test\\Controllers\\Article\\";
Route::get("test_ArticleGetMoreByUserTest",$__BasePrefix."ArticleTest@getMoreByUserTest");
Route::get("test_getMoreBySubjectTest",$__BasePrefix."ArticleTest@getMoreBySubjectTest");
Route::get("test_ArticleAddTest",$__BasePrefix."ArticleTest@addTest");
Route::get("test_ArticleSyncBaseInfoTest",$__BasePrefix."ArticleTest@syncBaseInfoTest");
Route::get("test_ArticleSyncReplyInfoTest",$__BasePrefix."ArticleTest@syncReplyInfoTest");
Route::get("test_ArticleUpdateTest",$__BasePrefix."ArticleTest@updateTest");
Route::get("test_ArticleDeleteTest",$__BasePrefix."ArticleTest@deleteTest");