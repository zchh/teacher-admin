
@extends("base")

@section("body")
@section("top_nav")
<link rel="stylesheet" type="text/css" href="/css/Index/index.css">
<script src="/js/Index/index.js" type="text/javascript"></script>
<div class="bgi_div">
    <img class="full_image" src="/image/index_bg.jpg">
</div>
 <nav class="navbar navbar-default navbar-fixed-top " style="opacity: 0.8" id="top_nav">
              <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="/">BaseCMS</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li><a href="/user_index"> <span class="glyphicon glyphicon glyphicon-heart-empty" aria-hidden="true"></span> 兴趣</a></li>
                    <li>
                        <a href="/index_sDisplayArticleClass" href="#menu-toggle" id="menu-toggle">
                             <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                             文章
                        </a>
                    </li>
                    <li><a href="/index_sSubject" href="#menu-toggle" id="menu-toggle">
                             <span class="glyphicon glyphicon glyphicon-tasks" aria-hidden="true"></span>
                             专题
                        </a></li>
                  
                  </ul>

                  <ul class="nav navbar-nav navbar-right">
                     <form class="navbar-form navbar-left" role="search" action="/index_findArticle" method="get">
                        <div class="form-group">
                          <input type="text" class="form-control" name="key" placeholder="文章搜索">
                        </div>
                        <button type="submit" class="btn btn-default">搜索</button>
                      </form>
                    
                   <li>
                   <li>
                       @if(session("user.user_status"))
                       <img href="/user_index" src="/getImage/{{session("user.user_image")}}" class=" img-circle" style="width:45px;height:45px;position: relative;z-index:2;">
                    
                        @endif
                   </li>
                   <li>
                      <a href="/admin_displayIndex" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                       
                        管理
                      </a>      
                        <ul class="dropdown-menu" >
                           
                            @if(session("user.user_status") == true)
                            <li><a href="/user_index">用户中心</a></li>
                            <li><a href="/user_uPersonalMessage">个人信息</a></li>
                            <li><a href="/user_logout">登出</a></li>
                            @else
                            <li><a href="/user_register" href="#menu-toggle" id="menu-toggle">注册</a></li>
                            <li><a href="/user_login" href="#menu-toggle" id="menu-toggle">登陆</a></li>
                            @endif
                            
                        </ul>  
                    </li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
        </nav> 



<div class="col-sm-12">
   <div class="panel panel-default">
        <div class="panel-body">
               <ul class="nav navbar-nav">

                <li><a href="/user_index">推荐</a></li>
                <li><a href="/user_sArticle">文章管理</a></li>
               

                 <li><a href="/user_sImage">图片管理</a></li>
              <li><a href="/user_sMessage">消息</a></li>
              
                <li>
                    <a href="/user_sFocus">关注</a>
                </li>
                  <li>
                    <a href="/index_userIndex/{{session("user.user_id")}}">个人主页</a>
                    
                </li>
                <li>
                    <a href="/user_uPersonalMessage">信息</a>
                    
                </li>
                    
            </ul>
         </div>
   </div>
</div> 
@show
@section("left_nav")

@show


@section("main")
@show
@append




