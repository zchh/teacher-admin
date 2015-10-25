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
        <div class="col-sm-2">
            <ul class="nav nav-sidebar">
                <li><a href="http://127.0.0.2:8080/admin_sAdmin">查看管理员</a></li>
                <li><a href="http://127.0.0.2:8080/admin_sAdminPowerGroup">查看权限组</a></li>
            </ul>
        </div>

        <div class="col-sm-10">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="sub-header">当前权限组：{{$GroupData[0]->group_name}}</h2>
                    <hr>
                    <form action="/admin_addPowerToAdminPowerGroup" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="col-sm-4 ">
                            <table  class="table">

                                <thead>
                                    <tr>
                                        <th>当前权限</th>
                                        
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($AdminPowerGroup as $data)

                                    <tr>
                                        <td>{{$data->power_name}}</td>
                                        <td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del_{{$data->relation_power_id}}">
                                                移除
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="del_{{$data->relation_power_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">警告！</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            将要移除该权限！
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="/admin_removePowerToAdminPowerGroup/{{$data->relation_power_id}}" class="btn btn-danger btn-sm">删除</a>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div></td>
                                    </tr>

                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </form>




                    <div class="col-sm-4 ">
                           <table  class="table">

                            <thead>
                                <tr>
                                    <th>当前管理员</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    @foreach ($articleAdmin as $data)
                                    @if($data->admin_group!=NULL)
                                    <td>{{$data->admin_username}}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del_admin_{{$data->admin_id}}">移除</button>
                                        <div class="modal fade" id="del_admin_{{$data->admin_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">警告！</h4>
                                                    </div>

                                                    <div class="modal-body">         
                                                        <form action="/admin_removeAdminToAdminPowerGroup" method="post">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="admin_id" value="{{ $data->admin_id }}">   
                                                            将要移除该管理员！ 
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button  class="btn btn-danger btn-sm" type="submit">移除</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </form>



                    <div class="col-sm-1 col-sm-offset-1 ">
                        <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#add_power_{{$GroupData[0]->group_id}}">添加权限</button>
                        <div class="modal fade" id="add_power_{{$GroupData[0]->group_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">请选择要添加的权限</h4>
                                    </div>
                                    <form action="/admin_addPowerToAdminPowerGroup" method="post">
                                        <div class="modal-body">            

                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="group_id" value="{{$GroupData[0]->group_id}}">   
                                            @foreach($checkPower as $value1)       
                                            <h4><input type="checkbox" name="power_id_array[]"  value="{{$value1->power_id}}" > {{$value1->power_id}} : {{$value1->power_name}}</input></h4>
                                            @endforeach       
                                        </div>
                                        <div class="modal-footer">
                                            <button  class="btn btn-primary " type="submit">添加</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_admin_{{$GroupData[0]->group_id}}">添加管理员</button>
                        <div class="modal fade" id="add_admin_{{$GroupData[0]->group_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">请选择要添加的管理员</h4>
                                    </div>
                                    <form action="/admin_addAdminToAdminPowerGroup" method="post">
                                        <div class="modal-body">                                            
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="group_id" value="{{$GroupData[0]->group_id}}">   
                                            @foreach($checkAdmin as $value2)
                                            @if($GroupData[0]->group_id == $value2->admin_group)
                                            <h4><input type="checkbox" value="{{$value2->admin_id}}"name="admin_id_array[]"  checked="checked"> {{$value2->admin_id}} : {{$value2->admin_username}}</input></h4>
                                            @else
                                            <h4><input type="checkbox" value="{{$value2->admin_id}}"name="admin_id_array[]"> {{$value2->admin_id}} : {{$value2->admin_username}}</input></h4>
                                            @endif
                                            @endforeach       
                                        </div>
                                        <div class="modal-footer">
                                            <button  class="btn btn-primary " type="submit">添加</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div><!-- /.blog-sidebar -->
            </div>
        </div>
    </div>
</div>
</div>
@stop