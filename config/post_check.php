<?php

/*所有需要验证的字段请写在这
第一维键名 第二维规则和信息 */
return [
    "reply_article"=>[ 
        "rule"=>['min:15',"active_url","alpha"],
        "message"=>"回复ID必须为数字"
        ],
    
    
    
    
    
    
    
];