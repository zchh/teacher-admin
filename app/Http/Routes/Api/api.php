<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/9
 * Time: 13:52
 */


//Route::group(['middleware' => ['LoginUserCheck']],function() {

    //Route::post("/api_aUser", "Api\BaseController@aUser");//添加用户 （注册用）
    //Route::post("/api_uUser", "Api\BaseController@uUser");//修改用户数据
    //Route::post("/api_sUser", "Api\BaseController@sUser");//查询一堆用户
    //文章的增删改查
    Route::post("/api_sArticle", "Api\ArticleController@sArticle");//返回符合接口描述文章所有信息的json
    //Route::post("/api_aArticle", "Api\ArticleController@aArticle");//
    //Route::post("/api_uArticle", "Api\ArticleController@uArticle");//
    Route::post("/api_dArticle", "Api\ArticleController@dArticle");//
    Route::post("/api_sArticleClass","Api\ArticleController@sArticleClass");



    //专题的增删改查
    /*Route::post("/api_sSubject", "Api\SubjectController@sSubject");//查询一个用户的专题
    Route::post("/api_aSubject", "Api\SubjectController@aSubject");//添加一个用户专题
    Route::post("/api_uSubject", "Api\SubjectController@uSubject");//更新一个用户专题
    Route::post("/api_dSubject", "Api\SubjectController@dSubject");//删除一个用户专题
    Route::post("/api_aSubjectArticle", "Api\SubjectController@aSubjectArticle");//添加一篇文章到专题
    Route::post("/api_dSubjectArticle", "Api\SubjectController@dSubjectArticle");//删除一篇文章从专题
    Route::post("/api_changeSortSubject", "Api\SubjectController@changeSortSubject");//更改一篇文章在专题中的顺序
    */
//});