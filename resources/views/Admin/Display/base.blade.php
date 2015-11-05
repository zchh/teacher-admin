@extends("Admin.base")
@section("left_nav")

        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-pills nav-stacked">
                <li class="<?php if(session("now_address") == "/admin_displayIndex"){echo "active";}?>"><a href="/admin_displayIndex">控制首页</a></li>
                <li class="<?php if(session("now_address") == "/admin_sRecommendArticle"){echo "active";}?>"><a href="/admin_sRecommendArticle">推荐文章</a></li>
                 <li class="<?php if(session("now_address") == "/admin_sRecommendSubject"){echo "active";}?>"><a href="/admin_sRecommendSubject">推荐专题</a></li>
                
            </ul>
        </div>

@append