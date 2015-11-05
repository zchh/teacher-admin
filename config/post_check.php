<?php

/*所有需要验证的字段请写在这
第一维键名 第二维规则和信息 */
return [
    "reply_article"=>[ 
        "rule"=>['min:15',"active_url","alpha"],
        "message"=>"回复ID必须为数字"
        ],
    
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
    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%end wjt
    
    
    
    
    
    
    
];