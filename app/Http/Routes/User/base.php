<?php




//用户前台相关页面
Route::get("/user_login","User\BaseController@login");
Route::get("/user_logout","User\BaseController@logout");
Route::post("/_user_login","User\BaseController@_login");


//用户注册 10/31
Route::get("/user_register","User\BaseController@register");        //交由张池完成 10/31
Route::post("/_user_register","User\BaseController@_register");     //交由张池完成 10/31




Route::group(['middleware' => ['LoginUserCheck']],function()
{
    
    //用户中心 10/31 wjt
    Route::get("/user_index","User\BaseController@index");      //主页
    
    Route::get("/user_logout","User\BaseController@logout");    //登出
    
    Route::get("/user_sInfo","User\BaseController@sInfo");          //用户信息
    Route::post("/_user_uInfo","User\BaseController@_sInfo");       //修改用户信息
    
    
    
    //关注人10/31   wjt
    Route::get("/user_sFocus","User\FriendController@sFocus");                       //查看关注人
    Route::get("/user_aFocus/{id}","User\FriendController@aFocus");                 //添加关注人
    Route::get("/user_dFocus/{id}","User\FriendController@dFocus");                  //删除关注人
    Route::get("/user_sFocusArticle","User\FriendController@sFocusArticle");        //查看关注人有哪些动态
    
    
    
    //用户文章  完成
    Route::get("/user_sArticle","User\ArticleController@sArticle");
    Route::get("/user_dArticle/{article_id}","User\ArticleController@dArticle");

    
    Route::get("/user_aArticle","User\ArticleController@aArticle");
    Route::post("/_user_aArticle","User\ArticleController@_aArticle");
    


    Route::get("/user_uArticle/{article_id}","User\ArticleController@uArticle");
    Route::post("/user_ajax_getNowArticleDetail","User\ArticleController@ajax_getNowArticleDetail");
    Route::post("/_user_uArticle","User\ArticleController@_uArticle");
    
    //文章访问
    Route::get("/user_readAllArticle","User\ArticleController@readAllArticle");//读取所有文章
    Route::get("/user_readSingleArticle/{article_id}","User\ArticleController@readSingleArticle");//读取单一文章
    Route::get("/user_publishReply","User\ReplyController@publishReply");
    

    //文章的评论管理
    Route::get("/user_sReply","User\ReplyController@sReply");       //查看评论
    Route::get("/user_moreReply","User\ReplyController@moreReply");       //评论详情
    Route::get("/user_dReply/{reply}","User\ReplyController@dReply");//删除评论
    
    //文章分类

    Route::get("/user_sClass","User\ClassController@sClass");//查看，select
    Route::post("/user_aClass","User\ClassController@aClass");//添加,add
    Route::post("/user_uClass","User\ClassController@uClass");//更新,update
    Route::get("/user_dClass/{class_id}","User\ClassController@dClass");//删除,delete

   //文章专题
    Route::get("/user_sSubject","User\ArticleController@sSubject");//查看专题
    Route::post("/user_aSubject","User\ArticleController@aSubject");//添加专题
    Route::post("/user_uSubject","User\ArticleController@uSubject");//修改专题
    Route::get("/user_dSubject/{subject_id}","User\ArticleController@dSubject");//删除专题
    
    Route::get("/user_moreSubject/{subject_id}","User\ArticleController@moreSubject");//专题详情
    Route::post("/user_addArticleToSubject","User\ArticleController@addArticleToSubject");//从专题添加文章
    Route::get("/user_removeArticleToSubject/{subject_id}/{article_id}","User\ArticleController@removeArticleToSubject");//从专题移出文章
    Route::get("/user_updatePositionInSubject","User\ArticleController@updatePositionInSubjec");//修改文章在专题的位置
    
    
    //标签
    Route::get("/user_sLabel","User\ArticleController@sLabel");//查看标签
    Route::post("/user_aLabel","User\ArticleController@aLabel");//添加标签
    Route::post("/user_uLabel","User\ArticleController@uLabel"); //修改标签
    Route::get("/user_dLabel/{label_id}","User\ArticleController@dLabel"); //删除标签
    
    
    

    //图片管理
    Route::get("/user_sImage","User\ImageController@sImage");

    Route::post("/user_aImage","User\ImageController@aImage"); //增加图片
    Route::get("/user_dImage/{image_id}","User\ImageController@dImage");
    Route::get("/user_uImage","User\ImageController@uImage");
    
    Route::get("/user_sMessage","User\MessageController@sMessage"); //查
    Route::post("/user_aMessage","User\MessageController@aMessage");//增
    Route::get("/user_dMessage","User\MessageController@dMessage");//删
    Route::post("/user_uMessage/{Message_id}","User\MessageController@uMessage"); //改
    
    //添加评论 11/1 wjt
    Route::post("/user_aReply","User\ReplyController@aReply");
    

    
    


});

?>