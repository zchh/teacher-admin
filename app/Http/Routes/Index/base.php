<?php
//10/31 wjt start
Route::get("/","Index\BaseController@index");
Route::get("/index_index","Index\BaseController@index");        //首页



Route::get("/index_findArticle","Index\BaseController@findArticle");        //查找文章显示结果的页面

Route::get("/index_articleDetail/{article_id}","Index\BaseController@articleDetail");          //文章详情的页面   //zc改

//Route::get("/index_sArticle","Index\BaseController@sArticle");       //查看很多文章页面，提供按类别查看的接口

Route::get("/index_userIndex/{user_id}","Index\BaseController@userIndex");     //用户主页，可以在这个页面看到用户当前的文章之类的  //用户首页，类比博客空间//zc改


Route::get("/index_sSubject/{class_id?}","Index\BaseController@sSubject");        //查看所有的专题

Route::get("/index_sClass","Index\BaseController@sClass");        //查看所有分类

Route::get("/index_moreSubject/{subject_id}","Index\BaseController@moreSubject");        //查看专题中的文章   //zc改
//10/31 wjt end


//查看类别
Route::get("/index_sDisplayArticleClass/{class_id?}","Index\BaseController@sDisplayArticleClass");


//图片访问接口
//获取图片
Route::get("/getImage/{image_id?}","Index\ImageController@getImage");
//上传图片，留给UE编辑器
Route::any("/putImage","Index\ImageController@putImage");



/*三方接口*/
Route::get("/if_qq_index","CommonIf\QQController@index");

?>
