<?php
//用户前台相关页面
Route::get("/user_login","User\BaseController@login");
Route::get("/user_logout","User\BaseController@logout");
Route::post("/_user_login","User\BaseController@_login");
Route::get("/user_register","User\BaseController@register");//用户注册页面
Route::post("/_user_register","User\BaseController@_register");//处理注册数据

/*//用户注册 10/31
Route::get("/user_register","User\BaseController@register");        //交由张池完成 10/31
Route::post("/_user_register","User\BaseController@_register");     //交由张池完成 10/31*/

//安全相关函数 11/12
Route::get("/user_checkMailUrl","User\SecureController@checkMailUrl");//注册验证链接
//Route::get("/user_sendMailUrl","User\SecureController@sendMailUrl");//发送测试demo 见控制器
//end


Route::group(['middleware' => ['LoginUserCheck']],function()
{
    
    //用户中心 10/31 wjt
    Route::get("/user_index","User\BaseController@index");      //主页
    
    Route::get("/user_logout","User\BaseController@logout");    //登出
    
    Route::get("/user_sInfo","User\BaseController@sInfo");          //用户信息
    Route::post("/_user_uInfo","User\BaseController@_sInfo");       //修改用户信息
    
    
    
    //用户文章  完成
    
    
    Route::get("/user_sArticle","User\ArticleController@sArticle");
    Route::get("/user_dArticle/{article_id}","User\ArticleController@dArticle");

    
    Route::get("/user_aArticle","User\ArticleController@aArticle");            //zc
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
    /*Route::get("/user_moreReply","User\ReplyController@moreReply");  */     //评论详情
    Route::get("/user_dReply/{reply_id}","User\ReplyController@dReply");//删除评论
    Route::post("/user_aReply","User\ReplyController@aReply");  //添加评论
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
    Route::get("/user_setSubjectArticleSort/{relation_id}/{up}","User\ArticleController@setSubjectArticleSort");
    
    
    //标签
    Route::get("/user_sLabel","User\ArticleController@sLabel");//查看标签
    Route::post("/user_aLabel","User\ArticleController@aLabel");//添加标签
    Route::post("/user_uLabel","User\ArticleController@uLabel"); //修改标签
    Route::get("/user_dLabel/{label_id}","User\ArticleController@dLabel"); //删除标签
    
  //收藏夹
    Route::get("/user_sCollect","User\CollectController@sCollect");//查看收藏夹
    Route::post("/user_aCollectClass","User\CollectController@aCollectClass");//添加收藏夹
    Route::post("/user_uCollectClass","User\CollectController@uCollectClass");//修改收藏夹
    Route::get("/user_dCollectClass/{class_id}","User\CollectController@dCollectClass");//删除收藏夹
    Route::post("/user_addArticleToCollect","User\CollectController@addArticleToCollect");//收藏文章
    Route::get("/user_dCollect/{collect_id}","User\CollectController@dCollect");//移除收藏文章
    Route::post("/user_uCollect","User\CollectController@uCollect");//修改收藏文章
    

    //图片管理
    Route::get("/user_sImage","User\ImageController@sImage");

    Route::post("/user_aImage","User\ImageController@aImage"); //增加图片
    Route::get("/user_dImage/{image_id}","User\ImageController@dImage");
    Route::get("/user_uImage","User\ImageController@uImage");
    Route::post("/user_aImageClass","User\ImageController@aImageClass");
    Route::post("/user_uImageClass","User\ImageController@uImageClass");
    Route::get("/user_dImageClass/{class_id}","User\ImageController@dImageClass");
    

    //消息
    Route::get("/user_sMessage","User\MessageController@sMessage"); //查
    Route::post("/user_aMessage","User\MessageController@aMessage");//增
    Route::get("/user_dMessage/{message_id}","User\MessageController@dMessage");//删
    
    
    //图片在框架里面添加
  
    Route::get("/user_sImageInFrame","User\ImageController@sImageInFrame");   //iframe网页，用于选择图片，zc
    Route::get("/user_sImageIdInFrame/{image_id}","User\ImageController@sImageIdInFrame");
    
    //个人信息
    //zc########################################################
     Route::get("/user_uPersonalMessage","User\PersonalMessageController@uPersonalMessage");  //修改个人信息表单界面
     Route::post("/_user_uPersonalMessage","User\PersonalMessageController@_uPersonalMessage");//修改个人信息
    
    //zc#########################################################

     //关注
    //wyf########################################################
     Route::get("/user_sFocus","User\FocusController@sFocus");//查看关注
     Route::post("/user_aFocus","User\FocusController@aFocus");//添加关注
     Route::get("/user_dFocus/{relation_id}","User\FocusController@dFocus");//取消关注
     Route::post("/user_uFocus","User\FocusController@uFocus");//修改备注
     //wyf#######################################################
});



?>
