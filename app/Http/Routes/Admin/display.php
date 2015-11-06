<?php
Route::group(['middleware' => ['LoginAdminCheck']],function()
{
    
    Route::get("/admin_displayIndex","Admin\DisplayController@displayIndex");     //控制首页
    
    //推荐文章组
    Route::get("/admin_sRecommendArticle","Admin\DisplayController@sRecommendArticle");       //推荐文章
    Route::post("/admin_aRecommendArticle","Admin\DisplayController@aRecommendArticle");       //添加推荐文章
    Route::get("/admin_dRecommendArticle/{recommend_id}","Admin\DisplayController@dRecommendArticle");       //删除推荐文章
    Route::post("/admin_uRecommendArticle","Admin\DisplayController@uRecommendArticle"); 
    

    
    Route::get("/admin_sRecommendSubject","Admin\DisplayController@sRecommendSubject");           //推荐专题
    Route::post("/admin_aRecommendSubject","Admin\DisplayController@aRecommendSubject");           //添加推荐专题
    Route::get("/admin_dRecommendSubject/{subject_id}","Admin\DisplayController@dRecommendSubject");           //删除推荐专题
    Route::post("/admin_uRecommendSubject","Admin\DisplayController@uRecommendSubject");//修改推荐专题
    
    
    //Route::get("/admin_sDisplaySubjectClass","Admin\DisplayController@sDisplaySubjectClass");      //展示级分类
    Route::post("/admin_aDisplayClass","Admin\DisplayController@aDisplayClass");     //添加分类
    Route::get("/admin_dDisplayClass/{class_id}","Admin\DisplayController@dDisplayClass");//删除分类
    Route::post("/admin_uDisplayClass","Admin\DisplayController@uDisplayClass");     //修改分类
    
});
?>
