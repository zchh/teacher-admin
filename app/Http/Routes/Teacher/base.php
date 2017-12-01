<?php

Route::get("/get_php_info", "Teacher\BaseController@getPhpInfo");                            //获取图片

/**
 * 管理员后台
 */
Route::get("/get_pic/{id}", "Teacher\BaseController@getPic");                                //获取图片
Route::get("/t_admin_login","Teacher\AdminController@adminLogin");                           //管理员登录
Route::post("/t_check_admin_login","Teacher\AdminController@checkAdminLogin");               //校验登录
Route::get("/t_admin_login_out","Teacher\AdminController@adminLoginOut");                    //退出登录
Route::group(['middleware' => ['TLoginAdminCheck']],function() {

    Route::post("/t_update_password", "Teacher\AdminController@updatePassword");              //修改密码

    Route::get("/t_admin_info", "Teacher\AdminController@getAdminInfo");                     //获取管理员信息
    Route::post("/t_edit_admin_info", "Teacher\AdminController@editAdminInfo");              //编辑管理员

    Route::get("/t_s_teacher_class/{teacher_id}", "Teacher\AdminController@sTeacherClass"); //获取教师班级
    Route::post("/t_edit_class_config", "Teacher\AdminController@editClassConfig");         //编辑教师班级
    Route::get("/t_delete_teacher_class/{classConfigId}", "Teacher\AdminController@deleteTeacherClass");    //删除教师班级

    Route::get("/t_admin_index", "Teacher\AdminController@adminIndex");                      //首页

    Route::get("/t_s_teacher", "Teacher\AdminController@searchTeacher");                     //教师
    Route::post("/t_add_teacher", "Teacher\AdminController@addTeacher");                     //添加教师
    Route::post("/t_edit_teacher", "Teacher\AdminController@editTeacher");                   //编辑教师
    Route::post("/t_bind_class", "Teacher\AdminController@bindClass");                       //绑定班级
    Route::get("/t_delete_teacher/{teacher_id}","Teacher\AdminController@deleteTeacher");    //删除教师

    Route::get("/t_s_student", "Teacher\AdminController@searchStudent");                     //学生
    Route::post("/t_add_student", "Teacher\AdminController@addStudent");                     //添加学生
    Route::post("/t_edit_student", "Teacher\AdminController@editStudent");                   //编辑学生
    Route::get("/t_delete_student/{student_id}", "Teacher\AdminController@deleteStudent");   //删除学生

    Route::get("/t_s_class", "Teacher\AdminController@searchClass");                         //班级
    Route::post("/t_add_class", "Teacher\AdminController@addClass");                         //添加班级
    Route::post("/t_edit_class", "Teacher\AdminController@editClass");                       //编辑班级
    Route::get("/t_delete_class/{class_id}", "Teacher\AdminController@deleteClass");         //删除班级

    Route::get("/t_s_major", "Teacher\AdminController@searchMajor");                         //专业
    Route::post("/t_add_major", "Teacher\AdminController@addMajor");                         //添加专业
    Route::post("/t_edit_major", "Teacher\AdminController@editMajor");                       //编辑专业
    Route::get("/t_delete_major/{major_id}", "Teacher\AdminController@deleteMajor");         //删除专业

    Route::get("/t_s_admin", "Teacher\AdminController@sAdmin");                              //管理员
    Route::post("/t_add_admin", "Teacher\AdminController@addAdmin");                         //添加管理员
    Route::post("/t_edit_admin", "Teacher\AdminController@editAdmin");                       //编辑管理员
    Route::get("/t_delete_admin/{admin_id}", "Teacher\AdminController@deleteAdmin");         //删除管理员

});




/**
 * 教师后台
 */
Route::get("/","Teacher\TeacherController@teacherLogin");
Route::get("/t_teacher_login","Teacher\TeacherController@teacherLogin");
Route::post("/t_check_teacher_login","Teacher\TeacherController@checkTeacherLogin");
Route::group(['middleware' => ['TLoginTeacherCheck']],function() {

    Route::get("/t_teacher_index", "Teacher\TeacherController@index");                     //首页

    Route::get("/t_teacher_login_out", "Teacher\TeacherController@teacherLoginOut");       //退出登录
    Route::get("/t_teacher_reset", "Teacher\TeacherController@teacherResetView");          //修改密码界面
    Route::post("/t_teacher_reset_password", "Teacher\TeacherController@resetPassword");   //修改密码

    Route::any("/t_get_student", "Teacher\TeacherController@getStudentByClass");            //管理学生
    Route::post("/t_make_student_remark", "Teacher\TeacherController@makeStudentRemark");   //备注学生信息

    Route::get("/t_teacher_s_class", "Teacher\TeacherController@getClass");                  //班级

    Route::get("/t_s_grade_config", "Teacher\TeacherController@getGradeConfig");              //得扣分配置
    Route::post("/t_add_grade_config", "Teacher\TeacherController@addGradeConfig");           //增加得扣分配置
    Route::post("/t_edit_grade_config", "Teacher\TeacherController@editGradeConfig");         //编辑得扣分配置
    Route::get("/t_delete_grade_config/{id}", "Teacher\TeacherController@deleteGradeConfig"); //删除得扣分配置

    Route::post("/t_make_grade", "Teacher\TeacherController@makeGrade");                      //打分
    Route::get("/t_get_grade_log/{student_id}", "Teacher\TeacherController@getGradeLog");     //获取分数记录
    Route::post("/t_s_grade_log", "Teacher\TeacherController@sGradeLog");                    //获取分数记录
    Route::get("/t_student_grade_trend/{student_id}", "Teacher\TeacherController@studentGradeTrend");   //学生成绩走势

});




?>
