<?php
Route::group(['middleware' => ['LoginAdminCheck']],function()
{
    
    Route::get("/admin_displayIndex","Admin\DisplayController@displayIndex");     //控制首页
    
    //推荐文章组
    Route::get("/admin_sRecommendArticle","Admin\DisplayController@sRecommendArticle");       //推荐文章
    Route::post("/admin_aRecommendArticle","Admin\DisplayController@aRecommendArticle");       //添加推荐文章
    Route::get("/admin_dRecommendArticle/{recommend_id}","Admin\DisplayController@dRecommendArticle");       //删除推荐文章
    
    
    //Route::get("/admin_sDisplayArticleClass","Admin\DisplayController@sDisplayArticleClass");     //查看推荐文章分类
    Route::post("/admin_aDisplayArticleClass","Admin\DisplayController@aDisplayArticleClass");     //添加文章分类
    Route::get("/admin_dDisplayArticleClass/{class_id}","Admin\DisplayController@dDisplayArticleClass");     //删除文章分类
    Route::post("/admin_uDisplayArticleClass","Admin\DisplayController@uDisplayArticleClass");     //修改文章分类
    
    Route::get("/admin_sRecommendSubject","Admin\DisplayController@sRecommendSubject");           //推荐专题
    Route::post("/admin_aRecommendSubject","Admin\DisplayController@aRecommendSubject");           //添加推荐专题
    Route::get("/admin_dRecommendSubject/{subject_id}","Admin\DisplayController@dRecommendSubject");           //删除推荐专题
    
    
    //Route::get("/admin_sDisplaySubjectClass","Admin\DisplayController@sDisplaySubjectClass");      //展示级专题分类
    Route::post("/admin_aDisplaySubjectClass","Admin\DisplayController@aDisplaySubjectClass");     //添加专题分类
    Route::get("/admin_dDisplaySubjectClass/{class_id}","Admin\DisplayController@dDisplaySubjectClass");//删除专题分类
    Route::post("/admin_uDisplaySubjectClass","Admin\DisplayController@uDisplaySubjectClass");     //修改专题分类
    
});
?>
