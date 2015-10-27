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
                          <a class="navbar-brand" href="#">前端</a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                          <ul class="nav navbar-nav">

                            <li><a href="/admin_login">管理员级登陆</a></li>
                            <li><a href="/user_login">用户级登陆</a></li>
                               


                          </ul>

                          <ul class="nav navbar-nav navbar-right">
                              


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
            



