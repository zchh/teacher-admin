@extends("Admin.Article.base")
@section("main")
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">类别添加</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/admin_aClass" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="exampleInputName" class="col-sm-2 control-label">类别名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="subject_name" name="class_name" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">添加</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- 导航条  -->

<!-- 文本内容 -->
<div class="col-sm-10">
    <div class="panel panel-default">
        <div class="panel-body">
            <!-- Button trigger modal -->
            <div class="navbar-form navbar-right">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
                    添加类别
                </button>
            </div>
            <h2 class="sub-header">文章分类列表</h2>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>类别ID</th>
                            <th>类别名字</th>
                            <th>创建日期</th>
                            <th>更新日期</th>
                            <th colspan="3">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($class_data as $data)
                        <tr>
                            <td>{{ $data->class_id }}</td>
                            <td>{{$data->class_name}}</td>
                            <td>{{$data->class_create_date}}</td>
                            <td>{{$data->class_update_date}}</td>
                            <td colspan="3">
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit{{$data->class_id}}">
                                    文章类别修改
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="edit{{$data->class_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">类别修改</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" action="/admin_uClass" method="post">
                                                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-2 control-label">类别ID</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="subject_id" name="class_id" value="{{$data->class_id}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-2 control-label">类别名</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="subject_name" name="class_name" value="{{$data->class_name}}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">修改</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <a class="btn btn-danger btn-sm" href="/admin_dClass/{{$data->class_id}}">删除</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- 分页 -->
            <?php echo $class_data->render(); ?>
        </div>
    </div>
</div>
@stop
