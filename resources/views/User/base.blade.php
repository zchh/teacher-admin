
@extends("base")

@section("body")
@section("top_nav")
<style>
    body { padding-top: 70px; }
</style>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Base CMS用户后台管理</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li><a href="/user_index">用户主页</a></li>

                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        文章管理<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/user_sArticle">查看文章</a></li>
                        <li><a href="/user_aArticle">添加文章</a></li>
                        <li><a href="/user_sSubject">文章专题</a></li>
                        <li><a href="/user_sClass">文章分类</a></li>
                        <li><a href="#">隐私设置</a></li>
                    </ul>
                </li>


                <li>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        图片管理<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/user_sImage">查看图片</a></li>
                        <li><a href="/user_aImage">添加图片</a></li>

                    </ul>
                </li>
                <li>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        云存储<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/user_sFile">查看文件</a></li>
                        <li><a href="/user_aFile">添加文件</a></li>

                    </ul>
                </li>
                <li><a href="/user_sMessage"  data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        消息箱<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" >
                        <li><a href="/user_sMessage">查看消息</a></li>
                        <li><a href="/user_aMessage">添加消息</a></li>
                    </ul>  




                </li>


            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        个人设置<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/">回到用户前端</a></li>
                        <li><a href="/user_sPersonalMessage">个人信息</a></li>
                        <li><a href="/user_logout">登出</a></li>

                    </ul>

                </li>


            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav> 
@show
@section("left_nav")

@show


@section("main")
@show
@append




