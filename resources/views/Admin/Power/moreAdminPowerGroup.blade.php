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

                <li><a href="admin_sAdmin">管理员权限</a></li>
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
                <li><a href="http://127.0.0.2:8080/admin_sAdmin">查看管理员</a></li>
                <li><a href="http://127.0.0.2:8080/admin_sAdminPowerGroup">查看权限组</a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
        </div>



        <h2 class="sub-header">当前权限组：{{$GroupData[0]->group_name}}</h2>
        <hr>
        <form action="/admin_addPowerToAdminPowerGroup" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-sm-2 ">
                <table  class="table-condensed table-bordered  table-striped">

                    <thead>
                        <tr>
                            <th><h4>权限管理</h4></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            foreach ($PowerData as $data) {
                                ?>
                            <tr>
                                <td><input type="checkbox" name="power_array[]" value="" >  {{$data->power_name}}</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tr>
                    </tbody>
                </table>

            </div>
        </form>
        <div class="col-sm-3 col-sm-offset-1 ">
            
                
                <button class="btn btn-lg btn-primary " type="submit">修改权限</button>
                <br>
                <hr>
                <button class="btn btn-lg btn-primary " type="submit">修改管理员</button>
                
          
        </div>  
    </div><!-- /.blog-sidebar -->
</div>

</div>
@stop