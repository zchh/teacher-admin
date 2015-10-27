@extends("Admin.Power.base")

@section("main")





<div class="col-sm-8">
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

        <hr>

        <div class="table-responsive" >
            <table  class="table table-striped" >
                <thead>
                    <tr class="container">
                        <th class="container">ID</th>
                        <th class="container">权限组</th>
                        <th class="container">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="container">
                        <?php
                        foreach ($GroupData as $data) {
                            ?>
                        <tr class="container">
                            <td class="container">{{$data->group_id}}</a></td>
                            <td class="container">{{$data->group_name}}</td>
                            <td class="container"><!-- Button trigger modal -->
                                <a href="/admin_moreAdminPowerGroup/{{$data->group_id}}" class="btn btn-info btn-sm" >详情</a>


                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#upd_{{$data->group_id}}" >修改</button>
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

            <hr>

            <div class="col-sm-4 col-sm-offset-4">
                <?php echo $GroupData->render(); ?>
            </div>

        </div>

    </div>

</div>
@stop