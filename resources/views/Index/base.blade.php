@extends("base")

@section("body")

@section("top_nav")
<style>

    
</style>
<div class="bgi_div">
    <img class="full_image" src="/image/index_bg.jpg">
</div>
<link rel="stylesheet" type="text/css" href="/css/Index/index.css">
<script src="/js/Index/index.js" type="text/javascript"></script>
            <nav class="navbar navbar-default navbar-fixed-top " style="opacity: 0.9;background-color: gainsboro" id="top_nav">
            <div class="container" style="">
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
@show



    @section("left_nav")
       
    @show
        


          
    @section("main")

    @show
     
    @section("footer")
    <footer class="main-fooder col-sm-12 "style="background-color: #f3f3f3;height: 90px;width: 100%;">
        <div class="container">
            <p class="col-lg-offset-5 text-muted  glyphicon glyphicon-copyright-mark" style="top: 50px;"> 2015 Struck by Cookie <a href="/admin_index">管理员级界面</a></p>

        </div>
    </footer>
`   @show
       
        
 @append
            



