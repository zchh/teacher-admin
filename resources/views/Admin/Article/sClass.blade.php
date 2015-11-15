@extends("Admin.Article.base")
@section("main")
<!-- Modal -->  
<div class="modal fade" id="manage_class" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">文章类别</h4>
            </div>
            <div class="modal-body">
                <!-- 3333333333 -->
                <div class="collapse" id="add_class">
                    <div class="well">
                        <form action="/admin_aClass" method="post">
                            <div class="form-group">
                                <input type="hidden"name="_token"value="{{ csrf_token() }}">
                                <label >新增类别名</label>
                                <input type="text" class="form-control" name="class_name" placeholder="新增类别">
                            </div>

                            <button type="submit" class="btn btn-default">提交</button>
                        </form>
                    </div>
                </div>

                @foreach($class_data as $data)
                <div class="collapse" id="update_class_{{$data->class_id}}">
                    <div class="well">
                        <form action="/admin_uClass" method="post">
                            <div class="form-group">
                                <label >类别名</label>
                                <input type="hidden"name="_token"value="{{ csrf_token() }}">
                                <input type="text" class="form-control" name="class_name" placeholder="修改" value="{{$data->class_name}}">
                                <input type="hidden" class="form-control" name="class_id" value="{{$data->class_id}}">
                            </div>

                            <button type="submit" class="btn btn-default">确认修改</button>
                        </form>
                    </div>
                </div>
                @endforeach


                <table class="table table-hover">
                    <tr>
                        <th>类名</th>
                        <th>操作</th>
                    </tr>
                    @foreach($class_data as $data)
                    <tr>
                        <td>{{$data->class_name}}</td>
                        <td>
                            <a class="btn btn-primary" role="button" data-toggle="collapse" 
                               href="#update_class_{{$data->class_id}}" 
                               aria-expanded="false" aria-controls="update_class_{{$data->class_id}}">
                                修改
                            </a>
                            <a href="/admin_dClass/{{$data->class_id}}" class="btn btn-danger" >删除</a>
                        </td>
                    </tr>    
                    @endforeach
                </table>
                <!-- 3333333333 -->
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" role="button" data-toggle="collapse" href="#add_class" aria-expanded="false" aria-controls="add_class">
                    新增
                </a>
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<!-- 文本内容 -->
<div class="col-sm-10">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-sm-10">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2 class="sub-header">文章分类列表</h2>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>类别ID</th>
                                        <th>类别名字</th>
                                        <th>创建日期</th>
                                        <th>更新日期</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($class_data as $data)
                                    <tr>
                                        <td>{{ $data->class_id }}</td>
                                        <td>{{$data->class_name}}</td>
                                        <td>{{$data->class_create_date}}</td>
                                        <td>{{$data->class_update_date}}</td>
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
            <div class="col-sm-2">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#manage_class">
                    类别管理
                </button>
            </div>

        </div>
    </div>
</div>
@stop

