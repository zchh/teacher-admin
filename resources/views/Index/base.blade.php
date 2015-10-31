@extends("base")

@section("body")

@section("top_nav")
        <style>
            body { padding-top: 50px; }
        </style>
        <link href="/css/simple-sidebar.css" rel="stylesheet">
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
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

 <div id="wrapper">

    @section("left_nav")
      <!-- Sidebar -->
      <div id="sidebar-wrapper">
          <ul class="sidebar-nav">
              <li class="sidebar-brand">

                <h3>查看类别</h3>

              </li>
              <li>
                  <a href="#">最热头条</a>
              </li>
              <li>
                  <a href="#">最新文章</a>
              </li>
              <li>
                  <a href="#">分类3</a>
              </li>

          </ul>
      </div>     
    @show
        

  
  <!-- /#sidebar-wrapper -->
 
  <!-- Page Content -->
  <div id="page-content-wrapper">
          
      @section("main")
      @show
         
  </div>
  <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Menu Toggle Script -->
<script>
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");/*切换类的样式*/
});
</script>








       
        
 @append
            



