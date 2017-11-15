@extends("Teacher.TeacherView.base")
@section("content")
<div class="wrapper wrapper-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>得/扣分类型配置管理</h5>
                        <div class="ibox-tools">
                            <a href="#add" data-toggle="modal" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> 新增配置</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>类型</th>
                                    <th>分数</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($arr as $single)
                                <tr>
                                    <td>{{ $single->type_id }}</td>
                                    <td>{{ $single->type_name }}</td>
                                    <td>{{ $single->grade }}</td>
                                    <td>
                                        <a href="#edit-form_{{ $single->type_id }}" class="btn btn-outline btn-success" data-toggle="modal">编辑</a>
                                        <a href="/t_delete_grade_config/{{ $single->type_id }}" class="btn btn-outline btn-danger" onclick="javascript:return confirm('确定删除该配置吗？')">删除</a>
                                    </td>


                                    <div id="edit-form_{{  $single->type_id }}" class="modal fade" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <h3 class="m-t-none m-b">修改得/扣分类型配置</h3>
                                                            <div class="hr-line-dashed"></div>
                                                            <div class="form-horizontal">
                                                                <form role="form" class="form-horizontal" action="/t_edit_grade_config" method="post" onsubmit="checkEditStaff(this)">
                                                                    <input type="hidden" name="id" value="{{$single->type_id }}">
                                                                    <div class="form-group">
                                                                        <label class="col-sm-2 control-label">类型</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text" placeholder="请输入类型" class="form-control" name="type_name" value="{{ $single->type_name }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-2 control-label">分数</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text" placeholder="请输入分数（扣分：-xx,加分：+xx）" class="form-control" name="grade" value="{{ $single->grade }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="col-sm-4 col-sm-offset-2">
                                                                            <button class="btn btn-primary" type="submit">保存</button>
                                                                            <button class="btn btn-white" data-dismiss="modal" type="button">取消</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


<div id="add" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">新增配置</h3>
                        <div class="hr-line-dashed"></div>
                        <form role="form" class="form-horizontal" action="/t_add_grade_config" method="post">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">类型</label>
                                <div class="col-sm-10">
                                    <input type="text" placeholder="请输入类型" class="form-control" name="type_name" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">分数</label>
                                <div class="col-sm-10">
                                    <input type="text" placeholder="请输入分数（扣分：-xx,加分：+xx）" class="form-control" name="grade" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">保存</button>
                                    <button class="btn btn-white" data-dismiss="modal" type="button">取消</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop
@section("footer")
@stop