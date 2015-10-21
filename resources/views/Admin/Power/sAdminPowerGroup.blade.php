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
                    
                    <li><a href="admin_sAdminPowerGroup">管理员权限</a></li>
                    <li><a href="#">用户权限</a></li>
                    <li><a href="#">文章</a></li>
                    <li><a href="#">图片库</a></li>
                    <li><a href="#">文件库</a></li>
                    <li><a href="#">消息</a></li>
                   
                  </ul>
                 
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="/admin_logout">登出</a></li>
                    
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
           </nav> 
        
<div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 ">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="admin_sAdminPowerGroup">查看权限 <span class="sr-only">(current)</span></a></li>
            <li><a href="admin_sAdmin">查看管理员用户</a></li>
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
          </ul>
          
        </div>
        

          <h2 class="sub-header">所有权限</h2>
          <div class="table-responsive">
            <table class="table table-striped" class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  
                  <th>权限</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                 <?php
       foreach($PowerData as $data)
		{
			?>
			<tr>
				<td>{{$data->power_id}}</a></td>
				<td>{{$data->power_name}}</td>
			</tr>
			<?php
		}
       ?>
                </tr>
               
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>