<?php

return [
    "title_name" => "Base CMS",
    
    "mail_head_name" => "Base CMS",
    "website_url"=>"http://127.0.0.5:8080",          //网站url
    "secure_check_url" => "/user_checkMailUrl",//安全检查跳转回的url
    "image_upload_dir" => "/../storage/app/image/",//文件上载路径
    "special_page" => ["/putImage?"],    //可以不检查token的页面
    "default_num_page" =>5
];

