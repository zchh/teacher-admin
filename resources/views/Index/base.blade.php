@extends("base")

@section("body")

@section("top_nav")
<style>
    body { padding-top: 60px; 
    background-color: #EEEEEE}
    
</style>
       
        <nav class="navbar navbar-default navbar-fixed-top " >
              <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#">前端</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li><a href="/user_index">最新文章</a></li>
                    <li><a href="/user_index" href="#menu-toggle" id="menu-toggle">分类</a></li>
                     <li><a href="/index_sSubject" href="#menu-toggle" id="menu-toggle">专题</a></li>

                  </ul>

                  <ul class="nav navbar-nav navbar-right">
                     <form class="navbar-form navbar-left" role="search" action="/index_findArticle" method="get">
                        <div class="form-group">
                          <input type="text" class="form-control" name="key" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">搜索</button>
                      </form>
                    <li><a href="/admin_index">管理员级界面</a></li>
                    <li><a href="/user_index">用户级界面</a></li>

                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
        </nav> 
@show



    @section("left_nav")
       
    @show
        


          
    @section("main")

    @show
         
<footer class="main-fooder "style="background-color: #f3f3f3;height: 90px; position: absolute;bottom: 0;width: 100%;">
    <div class="container">
        <p class="col-lg-offset-5 text-muted  glyphicon glyphicon-copyright-mark" style="top: 50px;"> 2015 Struck by Cookie</p>
    </div>
</footer>

       
        
 @append
            



