<?php

/* 所有需要验证的字段请写在这
  第一维键名 第二维规则和信息 */
return [


    
    
    //wjt%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    
    //文章推荐
    "recommend_name"=>[ 
        "rule"=>["alpha_num","max:30"],
        "message"=>"文章名不能大于30个字符"
        ],

     "recommend_class"=>[ 
        "rule"=>["integer"],
        
        ],
    "article_id"=>[ 
        "rule"=>["integer"],
        
        ],
     //文章推荐类别
    "class_name"=>[ 
        "rule"=>["alpha_num","max:30"],
        "message"=>"分类不能大于30个字符"
        ],
    "class_id"=>[ 
        "rule"=>["integer","max:10"],
        ],
      
    //推荐专题
     "recommend_subject"=>[ 
        "rule"=>["integer","max:10"],
        
        ],
    
     //11/11
    "article_title"=>[ 
        "rule"=>["max:50","required"],
        "message"=>"标题太长了，请限制在50个字符以内"
        ],
    
     "article_intro"=>[ 
        "rule"=>["max:150"],
        "message"=>"介绍请限制在150个字符以内"
        ],
    
    "article_class"=>[ 
        "rule"=>["numeric"],
        ],
    "article_sort" =>[
        "rule" =>["integer","max:100"],//,"min:150"测试ajax验证专用
        "message"=>"请确保排序为数字，且最大不超过100"
    ],
     "article_detail" =>[
        "rule" =>["max:60000"],
        "message"=>"文章不可超过60000字"
    ],
    // 11/11 end
  
    
    

    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%end wjt%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%


    
    //***********************************wyf
   "admin_username"=>[
       "rule"=>['alpha_dash'],
       "message"=>"用户名仅允许字母、数字、破折号（-）以及底线（_）"
   ],
    "admin_nickname"=>[
        "rule"=>['alpha_dash'],
        "message"=>"昵称仅允许字母、数字、破折号（-）以及底线（_）"
    ],
    "admin_password"=>[
        "rule"=>['alpha_dash'],
        "message"=>"密码仅允许字母、数字、破折号（-）以及底线（_）"
    ],
    "group_name"=>[
        "rule"=>['alpha_dash'],
        "message"=>"权限组名称仅允许字母、数字、破折号（-）以及底线（_）"
    ],
    "class_name"=>[
        "rule"=>['alpha_dash'],
        "message"=>"类别名称仅允许字母、数字、破折号（-）以及底线（_）"
    ],
    "lable_name"=>[
        "rule"=>['alpha_dash'],
        "message"=>"标签名称仅允许字母、数字、破折号（-）以及底线（_）"
    ],
    "subject_name"=>[
        "rule"=>['alpha_dash'],
        "message"=>"专题名称仅允许字母、数字、破折号（-）以及底线（_）"
    ],
    "subject_intro"=>[
        "rule"=>['alpha_dash'],
        "message"=>"专题介绍仅允许字母、数字、破折号（-）以及底线（_）"
    ],
    "relation_focus"=>[
        "rule"=>['alpha_dash'],
        "message"=>"专题介绍仅允许字母、数字、破折号（-）以及底线（_）"
    ],
    //*&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 
    

    
    

    //zhangchi#######################################################################################
    "class_name" => [                                         //添加/修改类名
        "rule" => ['max:15', "required"],
        "message" => "类名不能为空且字数不能超过15个"
    ],
    "image_name" => [                                   //修改/添加图片名
        "rule" => ['max:15', "required"],
        "message" => "图片名不能为空且字数不能超过15个"
    ],
    "image_intro" => [                                   ///添加/修改图片就介绍
        "rule" => ['max:34', "required"],
        "message" => "图片介绍不能为空且字数不能超过34个"
    ],
    
     "message_recv_user" => [                                   ///添加信息接收者
        "rule" => ['max:15', "required"],
        "message" => "消息接收者不能为空，且字数不能超过15"
    ],
    
    "message_title" => [                                   ///添加信息标题
        "rule" => ['max:34', "required"],
        "message" => "消息标题不能为空，且字数不能超过34"
    ],
    
    "message_data" => [                                   ///添加信息内容
        "rule" => ['max:341', "required"],
        "message" => "消息内容不能为空，且字数不能超过341"
    ],
    
   
     "user_nickname" => [                                   //修改个人信息的昵称
        "rule" => ['max:15', "required"],
        "message" => "昵称不能为空，且字数不能超过15"
    ],
    
     "user_sex" => [                                   //修改个人信息的性别
        "rule" => ['max:2', "required"],
        "message" => "性别不能为空，且字数不能超过2"
    ],
     "user_password" => [                                   //修改个人信息的密码
        "rule" => ["alpha_dash"],
        "message" => "仅允许字母、数字、破折号（-）以及底线（_）"
    ],

    
    
     "user_age" => [                                   //修改个人信息的年龄
        "rule" => ['integer', "required"],
        "message" => "年龄不能为空，且必须为整数值"
    ],
    
     "user_intro" => [                                   //修改个人信息的简介
        "rule" => ['max:34', "required"],
        "message" => "简介不能为空，且不能超过34个字"
    ],
        
    

        /*
          "image_file"=>[                                   //添加图片文件  ，暂时还未限定大小
          "rule"=>['image'],
          "message"=>"图片介绍不能为空且字数不能超过34个"
          ],
         */
    //end zhangchi@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    

   

    

    //***********************************wyf**************************************************
   "admin_username"=>[
       "rule"=>['alpha_dash'],
       "message"=>"用户名仅允许字母、数字、破折号（-）以及底线（_）"
   ],
    "admin_nickname"=>[
        "rule"=>['alpha_dash'],
        "message"=>"昵称仅允许字母、数字、破折号（-）以及底线（_）"
    ],
    "admin_password"=>[
        "rule"=>['alpha_dash'],
        "message"=>"密码仅允许字母、数字、破折号（-）以及底线（_）"
    ],
    "group_name"=>[
        "rule"=>['alpha_dash'],
        "message"=>"权限组名称仅允许字母、数字、破折号（-）以及底线（_）"
    ],
    "class_name"=>[
        "rule"=>['alpha_dash'],
        "message"=>"类别名称仅允许字母、数字、破折号（-）以及底线（_）"
    ],
    "lable_name"=>[
        "rule"=>['alpha_dash'],
        "message"=>"标签名称仅允许字母、数字、破折号（-）以及底线（_）"
    ],
    "subject_name"=>[
        "rule"=>['alpha_dash'],
        "message"=>"专题名称仅允许字母、数字、破折号（-）以及底线（_）"
    ],
    "subject_intro"=>[
        "rule"=>['alpha_dash'],
        "message"=>"专题介绍仅允许字母、数字、破折号（-）以及底线（_）"
    ],


    
    //***********************************wyf end&*************************************************

    




    //管理员文章部分（#包含的内容是彭亮写的）########################################################3
    "subject"=>[
        "rule"=>['required'],     //文章并入专题
        "message"=>"必须选择一个专题"
    ],
    "label_id"=>[
        "rule"=>['required','digits:10'],     //为文章添加标签
        "message"=>"必须选择一个标签"
    ],
    "article_id_array"=>[       //选择一个或多篇文章添加到当前专题（控制器接收的数据为数组）
        "rule"=>['required','array'],
        "message"=>"选项框不能为空",
    ],
    "class_name"=>[     //添加类别
        "rule"=>['required','string'],
        "message"=>"类别名称不能为空"
    ],
    "class_id"=>[       //类别修改
        "rule"=>['required','digits:10'],
        "message"=>"类别ID不能为空"
    ],
    "label_name"=>[     //添加标签
        "rule"=>['required','string'],
        "message"=>"标签名称不能为空"
    ],
    "label_id"=>[       //标签修改
        "rule"=>['required','digits:10'],
        "message"=>"标签ID不能为空"
    ],
    "subject_name"=>[       //添加专题
        "rule"=>['required','string'],
        "message"=>"专题名称不能为空"
    ],
    "subject_intro"=>[       //添加专题
        "rule"=>['required','string'],
        "message"=>"专题介绍不能为空"
    ],
    "subject_id"=>[       //修改专题
        "rule"=>['required'],
        "message"=>"专题ID不能为空"
    ],
    //用户权限部分（彭亮）
    "user_username"=>[       //添加用户（用户名）
        "rule"=>['required','max:50'],
        "message"=>"用户名不能为空"
    ],
    "user_nickname"=>[       //添加用户（用户昵称）
        "rule"=>['max:50'],
        "message"=>"用户昵称长度不能超过50"
    ],
    "user_password"=>[       //添加用户（用户密码）
        "rule"=>['required','max:50'],
        "message"=>"密码为必填项"
    ],
    "user_group"=>[       //添加用户（用户权限组）
        "rule"=>['required'],
        "message"=>"必选为用户选择一个权限组"
    ],
   "group_name"=>[       //添加权限组
        "rule"=>['required','max:50'],
        "message"=>"此字段不能为空"
    ],
    "power_id_array"=>[       //添加权限到当前权限组
        "rule"=>['required','array'],
        "message"=>"至少得选择一项权限"
    ],
    "user_id_array"=>[       //添加用户到当前权限组
        "rule"=>['required','array'],
        "message"=>"至少得选择一个用户"
    ],
    //#########################################################
];
