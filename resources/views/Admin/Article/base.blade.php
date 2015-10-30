@extends("Admin.base")

@section("left_nav")
<!-- 导航条  -->
<div class="col-sm-3 col-md-2 sidebar">

    <ul class="nav nav-pills nav-stacked">
        <li class="<?php if(session("now_address") == "/admin_sArticle"){echo "active";}?>"><a href="/admin_sArticle">查看文章 <span class="sr-only">(current)</span></a></li>
        <li class="<?php if(session("now_address") == "/admin_sLebel"){echo "active";}?>"><a href="/admin_sLebel">查看所有标签</a></li>
    </ul>
    <ul class="nav nav-pills nav-stacked">
        <li class="<?php if(session("now_address") == "/admin_sSubject"){echo "active";}?>"><a href="/admin_sSubject">查看所有的专题</a></li>
        <li role="presentation"><a href="/admin_sClass">查看所有分类</a></li>
        <li role="presentation"><a href="">待续.....</a></li>
    </ul>
</div>
<!--  
<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li class="level1">
            <a href="#none">文章</a>
            <ul class="level2">
                <li><a href="/admin_sArticle">查看文章 <span class="sr-only">(current)</span></a></li>
            </ul>
        </li>
        <li class="level1">
            <a href="#none">专题</a>
            <ul class="level2">
                <li><a href="/admin_sSubject">查看所有的专题</a></li>
            </ul>
        </li>
        <li class="level1">
            <a href="#none">标签</a>
            <ul class="level2">
                <li><a href="/admin_sLebel">查看所有标签</a></li>
            </ul>
        </li>
    </ul>
</div>-->
<script>
    $(".level1 > a").click(function() {
        $(this).addClass("current")
                .next().show()
                .parent().siblings().children("a").removeClass("current")
                .next().hide();
        return false;
    });
</script>
@append


