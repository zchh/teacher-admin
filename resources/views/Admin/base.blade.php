@extends("base")


@section("body")

        
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
                  <a class="navbar-brand" href="#">Base CMS</a>
                </div>

                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li><a href="/admin_sAdmin">管理员权限</a></li>
                    <li><a href="/admin_sUser">用户权限</a></li>
                    <li><a href="/admin_sArticle">文章</a></li>
                    <li><a href="#">图片库</a></li>
                    <li><a href="#">文件库</a></li>
                    <li><a href="/admin_sMessage">消息</a></li>
                   
                  </ul>
                 
                   <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                个人操作<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/">回到用户前端</a></li>
                                <li><a href="/admin_info">个人信息</a></li>
                                <li><a href="/admin_logout">登出</a></li>

                            </ul>

                        </li>
                 </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
           </nav>   



@section("left_nav")

@show


@section("main")

@show
@append

