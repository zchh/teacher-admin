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
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#">Base CMS</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                   
                  </ul>
                 
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="/admin_logout">登出</a></li>
                    
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
           </nav>   


            <div class="col-sm-12">
                   <div class="panel panel-default">
                        <div class="panel-body">
                                @section("top")
                                @show
                         </div>
                   </div>
           </div>


            <div class="col-sm-2">
                   <div class="panel panel-default">
                        <div class="panel-body">
                                @section("left")
                                @show
                         </div>
                   </div>
           </div>


            <div class="col-sm-10">
                   <div class="panel panel-default">
                        <div class="panel-body">
                                @section("main")
                                @show
                         </div>
                   </div>
           </div>


            <div class="col-sm-12">
                   <div class="panel panel-default">
                        <div class="panel-body">
                                @section("footer")
                                @show
                         </div>
                   </div>
           </div>




@append

