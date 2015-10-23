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
                <li><a href="admin_sAdmin">查看管理员</a></li>
                <li><a href="admin_sAdminPowerGroup">查看权限组</a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
        </div>



        <h2 class="sub-header">管理员用户 | <button class="btn  btn-primary "  data-toggle="modal" data-target="#aAdmin" type="button">添加管理员</button></h2>

        <div class="modal fade" id="aAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">添加管理员用户</h4>
                    </div>
                    <div class="modal-body">
                        <form action="/_aAdmin" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <h4>管理员用户名</h4>
                            <input type="text " id="inputText" class="form-control" name="admin_username" placeholder="Admin Username" required autofocus>

                            <h4>管理员昵称</h4>
                            <input type="text" id="inputText" class="form-control"  name="admin_nickname" placeholder="Admin Nickname" required autofocus>

                            <h4>密码</h4>
                            <input type="password" id="inputPassword" class="form-control" name="admin_password" placeholder="Admin Password" required>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-sm btn-primary" type="submit">提交</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">

            <table class="table table-striped" class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>用户名</th>
                        <th>昵称</th>
                        <th>所属权限组</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        foreach ($AdminData as $data) {
                            ?>
                        <tr>
                            <td>{{$data->admin_id}}</a></td>
                            <td>{{$data->admin_username}}</td>
                            <td>{{$data->admin_nickname}}</td>
                            <td>{{$data->admin_group}}</td>
                            <td><!-- Button trigger modal -->
                                
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#upd_{{$data->admin_id}}">修改</button>
                                <div class="modal fade" id="upd_{{$data->admin_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">当前管理员ID：{{$data->admin_id}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/admin_uAdmin" method="post">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <h4>请输入新的管理员用户名</h4>
                                                    <input type="hidden" name="admin_username" value="{{$data->admin_username}}">
                                                    <input type="text " id="inputText" class="form-control" name="admin_username" placeholder="Admin username" value="{{$data->admin_username}}" required autofocus>
                                                    <h4>请输入新的管理员昵称</h4>
                                                    <input type="hidden" name="admin_nickname" value="{{$data->admin_username}}">
                                                    <input type="text " id="inputText" class="form-control" name="admin_nickname" placeholder="Admin nickname" value="{{$data->admin_nickname}}" required autofocus>
                                            </div>
                                            <div class="modal-footer">
                                                <button  class="btn btn-danger btn-sm" type="submit">提交</a>
                                                    </form>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del_{{$data->admin_id}}">
                                    删除
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="del_{{$data->admin_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">警告！</h4>
                                            </div>
                                            <div class="modal-body">
                                                将要删除该管理员用户！
                                            </div>
                                            <div class="modal-footer">
                                                <a href="/admin_dAdmin/{{$data->admin_id}}" class="btn btn-danger btn-sm">删除</a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>

                                            </div>
                                        </div>
                                    </div>
                                </div></td>
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
@stop