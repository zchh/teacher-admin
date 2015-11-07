<?php

/*所有需要验证的字段请写在这
第一维键名 第二维规则和信息 */
return [
    
    
    //wjt………………………………………………………………………………………………
    
    //文章推荐
    "recommend_name"=>[ 
        "rule"=>["alpha_num","max:30"],
        "message"=>"文章名不能大于30个字符"
        ],

     "recommend_class"=>[ 
        "rule"=>["integer","max:10"],
        
        ],
    "article_id"=>[ 
        "rule"=>["integer","max:10"],
        
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
    
    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%end wjt

    //***********************************wyf
   

    
    //*&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    
    
    
    
    
    
];
