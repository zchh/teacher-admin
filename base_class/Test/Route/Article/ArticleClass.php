
<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 16:26
 */
$__BasePrefix = "BaseClass\\Test\\Controllers\\Article\\";
Route::get("test_ArticleClassAddTest",$__BasePrefix."ArticleClassTest@addTest");
Route::get("test_ArticleClassGetMoreByUserTest",$__BasePrefix."ArticleClassTest@getMoreByUserTest");
Route::get("test_ArticleClassUpdateTest",$__BasePrefix."ArticleClassTest@updateTest");
Route::get("test_ArticleClassDeleteTest",$__BasePrefix."ArticleClassTest@deleteTest");
