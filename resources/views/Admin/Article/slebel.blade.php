@extends("Admin.Article.te")
@section("main")
<!-- Modal1 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">添加标签</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/admin_aLebel" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">标签名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="label_name" name="label_name" value="">
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


<div class="col-sm-10">
    <div class="panel panel-default">
        <div class="panel-body">
            <!-- Button trigger modal -->
            <div class="navbar-form navbar-right">
                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">
                    添加标签
                </button>
            </div>
            <h2 class="sub-header">文章标签列表</h2><hr>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>序号</th>
                            <th>标签名</th>
                            <th>创建日期</th>
                            <th>更新日期</th>
                            <th colspan="3">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($label_data as $key => $data)
                        <tr>
                            <td>{{ $data->label_id }}</td>
                            <td>{{ $data->label_name }}</td>
                            <td>{{ $data->label_create_date }}</td>
                            <td>{{ $data->label_update_date }}</td>
                            <td colspan="3">
                                <!-- Modal2 -->
                                <div class="modal fade" id="edit_label{{$data->label_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" action="/_admin_uLabel" method="post">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-2 control-label">标签ID</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="label_id" name="label_id" value="{{$data->label_id}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-2 control-label">标签名</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="label_name" name="label_name" value="{{$data->label_name}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="submit" id="label" class="btn btn-info">更新</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
 
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_label{{$data->label_id}}">
                                    编辑
                                </button>
                                <a class="btn btn-primary" href="/admin_dLebel/{{$data->label_id}}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <?php echo $label_data->render(); ?>
            </div>
        </div>
    </div>
</div>

@stop