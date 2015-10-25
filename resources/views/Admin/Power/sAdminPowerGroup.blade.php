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
        <div class="col-sm-2 ">
            <ul class="nav nav-sidebar">
                <li><a href="admin_sAdmin">查看管理员</a></li>
                <li><a href="admin_sAdminPowerGroup">查看权限组</a></li>
            </ul>
        </div>

<div class="col-sm-10">
<div class="panel panel-default">
  <div class="panel-body">
        <h2 class="sub-header">所有权限组 | <button class="btn  btn-primary "  data-toggle="modal" data-target="#aAdminPowerGroup" type="button">添加权限组</button></h2>
        <div class="modal fade" id="aAdminPowerGroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">添加权限组</h4>
                    </div>
                    <div class="modal-body">
                        <form action="/_aAdminPowerGroup" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <h4>权限组名称</h4>
                            <input type="text " id="inputText" class="form-control" name="group_name" placeholder="Group name" required autofocus>
                            <div class="modal-footer">
                                <button class="btn btn-sm btn-primary" type="submit">提交</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="table-responsive" >
        <table  class="table table-striped" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>权限组</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    foreach ($GroupData as $data) {
                        ?>
                    <tr>
                        <td>{{$data->group_id}}</a></td>
                        <td>{{$data->group_name}}</td>
                        <td><!-- Button trigger modal -->
                            <a href="/admin_moreAdminPowerGroup/{{$data->group_id}}" class="btn btn-info btn-sm">详情</a>


                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#upd_{{$data->group_id}}">修改</button>
                            <div class="modal fade" id="upd_{{$data->group_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">请输入新的权限组名称</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/admin_uAdminPowerGroup" method="post">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="group_id" value="{{$data->group_id}}">
                                                <input type="text " id="inputText" class="form-control" name="group_name" placeholder="Group name" value="{{$data->group_name}}" required autofocus>

                                                </div>
                                                <div class="modal-footer">
                                                    <button  class="btn btn-warning btn-sm" type="submit">修改</a>
                                                        </form>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del_{{$data->group_id}}">删除</button>
                                <div class="modal fade" id="del_{{$data->group_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">警告！</h4>
                                            </div>
                                            <div class="modal-body">
                                                将要删除该权限组！
                                            </div>
                                            <div class="modal-footer">
                                                <a href="/admin_dAdminPowerGroup/{{$data->group_id}}" class="btn btn-danger btn-sm">删除</a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </td>

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