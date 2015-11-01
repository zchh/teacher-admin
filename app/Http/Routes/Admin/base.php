<?php



Route::get("/admin_login","Admin\BaseController@login");

Route::post("/_admin_login","Admin\BaseController@_login");
Route::group(['middleware' => ['LoginAdminCheck']],function()
{
    Route::get("/admin_index","Admin\BaseController@index");
    Route::get("/admin_logout","Admin\BaseController@logout");
    
    /*
     * 管理员权限组管理功能
     * 说明：多管理员系统需要一些权限限制，这些路由依次提供 查找所有权限组，
     * 控制器：PowerController
    */
    Route::get("/admin_sAdminPowerGroup","Admin\PowerController@sAdminPowerGroup");//查看所有的权限组
    Route::get("/admin_aAdminPowerGroup","Admin\PowerController@aAdminPowerGroup");//添加权限组
    Route::post("/_aAdminPowerGroup","Admin\PowerController@_aAdminPowerGroup");//执行添加权限组
    Route::get("/admin_dAdminPowerGroup/{group_id}","Admin\PowerController@dAdminPowerGroup");//删除权限组

    Route::get("/admin_moreAdminPowerGroup/{group_id}","Admin\PowerController@moreAdminPowerGroup");           //查看一个权限组的详情
    Route::post("/admin_uAdminPowerGroup","Admin\PowerController@uAdminPowerGroup");                 //修改权限组信息 (弹出框修改)
    Route::post("/admin_addAdminToAdminPowerGroup","Admin\PowerController@addAdminToAdminPowerGroup");           //添加用户到一个权限组,在详情页进行操作
    Route::post("/admin_removeAdminToAdminPowerGroup","Admin\PowerController@removeAdminToAdminPowerGroup");     //从一个权限组移出用户，在详情页操作
    Route::post("/admin_addPowerToAdminPowerGroup","Admin\PowerController@addPowerToAdminPowerGroup");         //添加权限到一个权限组,在详情页进行操作
    Route::get("/admin_removePowerToAdminPowerGroup/{relation_power_id}","Admin\PowerController@removePowerToAdminPowerGroup");     //从一个权限组移出权限，在详情页操作

    Route::get("/admin_sAdmin","Admin\PowerController@sAdmin");//查看所有的管理员用户
    Route::get("/admin_aAdmin","Admin\PowerController@aAdmin");//添加一个管理员用户
    Route::post("/_aAdmin","Admin\PowerController@_aAdmin");//执行添加一个管理员用户
    Route::get("/admin_dAdmin/{admin_id}","Admin\PowerController@dAdmin");//删除某个管理员用户

    Route::get("/admin_moreAdmin/{admin_id}","Admin\PowerController@moreAdmin");//查看一个管理员用户的详情
    Route::post("/admin_uAdmin","Admin\PowerController@uAdmin");//修改某个管理员用户

    
    
    /*
    /*
     * 用户级权限组管理功能
     * 说明： 对于各种用户有不同的权限限制，这些权限组成一个权限组，用户和权限组关联
     *  */
    Route::get("/admin_sUserPowerGroup","Admin\UserPowerController@sUserPowerGroup");//查看所有的权限组（zuo）
    Route::post("/admin_aUserPowerGroup","Admin\UserPowerController@aUserPowerGroup");//添加权限组（zuo）
    Route::get("/admin_dUserPowerGroup/{group_id}","Admin\UserPowerController@dUserPowerGroup");//删除权限组(zuo)

    Route::get("/admin_moreUserPowerGroup/{group_id}","Admin\UserPowerController@moreUserPowerGroup");           //查看一个权限组的详情（zuo）
    Route::post("/admin_uUserPowerGroup","Admin\UserPowerController@uUserPowerGroup");                            //修改权限组信息 (弹出框修改)（zuo）
    Route::post("/admin_addUserToUserPowerGroup","Admin\UserPowerController@addUserToUserPowerGroup");           //添加用户到一个权限组,在详情页进行操作(zuo)
    Route::post("/admin_removeUserToUserPowerGroup","Admin\UserPowerController@removeUserToUserPowerGroup");     //从一个权限组移出用户，在详情页操作(zuo)
    Route::post("/admin_addPowerToUserPowerGroup","Admin\UserPowerController@addPowerToUserPowerGroup");         //添加权限到一个权限组,在详情页进行操作
    Route::get("/admin_removePowerToUserPowerGroup/{group_id}/{power_id}","Admin\UserPowerController@removePowerToUserPowerGroup");     //从一个权限组移出权限，在详情页操作(zuo)

    Route::get("/admin_sUser","Admin\UserPowerController@sUser");//查看所有的用户 (zuo)
    Route::post("/admin_aUser","Admin\UserPowerController@aUser");//添加一个用户 （zuo）
    Route::post("/admin_dUser/{user_id}","Admin\UserPowerController@dUser");//删除某个用户 (zuo)

    //Route::get("/admin_moreUser","Admin\UserPowerController@moreUser");//查看一个用户的详情
    Route::post("/admin_uUser","Admin\UserPowerController@uUser");//修改某个用户 (zuo)

    /*
     * 文章管理组
     * 说明：对用户的文章进行管理
     * 控制器：ArticleController
     *  */
    /*文章分类部分*/
    Route::get("/admin_sClass","Admin\ArticleController@sClass");  //查看所有文章分类
    Route::post("/admin_uClass","Admin\ArticleController@uClass"); //修改文章类别
    Route::get("/admin_dClass/{class_id}","Admin\ArticleController@dClass");  //删除分类
    Route::post("/admin_aClass","Admin\ArticleController@aClass");
    /*
     * 
     */
    
    Route::get("/admin_sArticle","Admin\ArticleController@sArticle");   //查看文章(zuo)
    Route::post("/admin_sArticleByCondition","Admin\ArticleController@sArticleByCondition");
    Route::get("/admin_aArticle","Admin\ArticleController@aArticle");   //添加文章(zuo)
    //Route::post("/_admin_aArticle","Admin\ArticleController@_aArticle");   //添加文章(zuo)
    Route::post("/admin_aAticleLabel","Admin\ArticleController@aAticleLabel");      //给文章添加标签(zuo)
    //Route::get("/_admin_aAticleLabel/{article_id}","Admin\ArticleController@_aAticleLabel"); //给文章添加标签，路由到表单提交页面(zuo)
    Route::get("/admin_dArticle/{article_id}","Admin\ArticleController@dArticle");   //删除文章(zuo)

    //Route::get("/admin_moreArticle","Admin\ArticleController@moreArticle");     //文章详情
    Route::post("/admin_uArticle","Admin\ArticleController@uArticle");          //更新文章(zuo)
    //Route::post("/admin_RemoveArticleReply","Admin\ArticleController@RemoveArticleReply"); //移除评论  预留
    //Route::post("/admin_AddArticleLabel","Admin\ArticleController@AddArticleLabel");         //添加标签
    Route::post("/admin_RemoveArticleLabel","Admin\ArticleController@RemoveArticleLabel");       //移出标签


    Route::get("/admin_sLebel","Admin\ArticleController@sLebel");     //查看所有标签(zuo)
    Route::get("/admin_dLebel/{label_id}","Admin\ArticleController@dLebel");     //删除一个标签(zuo)
    //Route::get("/admin_aLebel","Admin\ArticleController@aLebel");
    Route::post("/admin_aLebel","Admin\ArticleController@aLebel");           //添加标签(zuo)
    Route::get("/admin_uLabel/{label_id}","Admin\ArticleController@uLebel");             //修改标签
    Route::post("/_admin_uLabel","Admin\ArticleController@_uLebel");  //修改后弹出的提示信息

    Route::get("/admin_sSubject","Admin\ArticleController@sSubject");         //查看所有的专题（zuo）
    //Route::get("/admin_aSubject","Admin\ArticleController@aSubject");
    Route::post("/admin_aSubject","Admin\ArticleController@aSubject");           //处理添加专题传过来的信息并进行添加（zuo）
    Route::get("/admin_sSubject/{subject_id}","Admin\ArticleController@dSubject");          //删除专题（zuo）

    Route::get("/admin_moreSubject/{subject_id}","Admin\ArticleController@moreSubject");           //专题详情(zuo)
    //Route::post("/admin_uSubject","Admin\ArticleController@_uSubject"); 
    Route::post("/admin_uSubject","Admin\ArticleController@uSubject");        //修改专题（zuo）
    Route::post("/admin_AddArticleToSubject","Admin\ArticleController@AddArticleToSubject");   //添加一篇文章到专题（zuo）
    Route::post("/admin_AddArticleToSubject2","Admin\ArticleController@AddArticleToSubject2");   //添加一篇文章到专题（zuo）
    Route::get("/admin_RemoveArticleToSubject/{subject_id}/{article_id}","Admin\ArticleController@RemoveArticleToSubject");//从专题移出一篇文章(zuo)



   


});


?>