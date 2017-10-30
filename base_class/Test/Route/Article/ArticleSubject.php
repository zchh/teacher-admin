<?php
/**
 * Created by PhpStorm.
 * User: yanghe
 * Date: 2015/12/18
 * Time: 15:52
 */
$__BasePrefix = "BaseClass\\Test\\Controllers\\Article\\";
Route::get("/test_getMoreByUserTest",$__BasePrefix."ArticleSubjectTest@getMoreByUserTest");
Route::get("/test_addTest",$__BasePrefix."ArticleSubjectTest@addTest");
Route::get("/test_syncBaseInfoTest",$__BasePrefix."ArticleSubjectTest@syncBaseInfoTest");
Route::get("/test_syncArticleInfoTest",$__BasePrefix."ArticleSubjectTest@syncArticleInfoTest");
Route::get("/test_SubjectUpdateTest",$__BasePrefix."ArticleSubjectTest@SubjectUpdateTest");
Route::get("/test_SubjectDeleteTest",$__BasePrefix."ArticleSubjectTest@SubjectDeleteTest");
Route::get("/test_SubjectAddArticleTest",$__BasePrefix."ArticleSubjectTest@SubjectAddArticleTest");
Route::get("/test_SubjectRemoveArticleTest",$__BasePrefix."ArticleSubjectTest@SubjectRemoveArticleTest");