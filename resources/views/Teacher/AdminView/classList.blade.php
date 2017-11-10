@extends("Teacher.AdminView.base")
@section("content")
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">班级管理</h4>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12">
                <form  class="class=form-inline" role="form" method="post" action="">
                    <div class="form-group" >
                        <a href="" class="btn btn-ms btn-success" role="button" data-toggle="modal" data-target="#new"><span class="glyphicon glyphicon-plus"></span>添加班级</a>

                        <input name="keyWords"  type="text" value="" placeholder="请输入仓库名">
                        <button type="submit"   class="btn btn-ms btn-primary" style="margin-left: 8px">搜索</button>
                        <button type="submit"   class="btn btn-ms btn-primary" style="margin-left: 8px">显示全部</button>
                    </div>
                </form>
                <div class="panel panel-default">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>专业</th>
                                    <th>班级名称</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($arr as $single)
                                    <tr>
                                        <td >{{$single->class_id}}</td>
                                        <td>
                                           @foreach($majorArr as $major)
                                           @if($major->major_id == $single->major_id)
                                               {{$major->major_name}}
                                           @endif
                                           @endforeach
                                        </td>
                                        <td>{{$single->class_name}}</td>
                                        <td >
                                            <a href=""  data-toggle="modal" data-target="#edit_{{ $single->class_id }}" class="btn btn-xs btn-primary" data-placement="top"
                                               title="编辑"><i  class="glyphicon glyphicon-pencil"></i></a>
                                            <a href="/t_delete_class/{{$single->class_id}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top"
                                               title="删除" onclick="javascript:return confirm('确定删除该班级吗？')"><i  class="fa fa-trash"></i></a>
                                        </td>


                                        <div class="modal fade" id="edit_{{ $single->class_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">编辑班级</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-horizontal">
                                                            <form class="form-horizontal" method="post" action="/t_edit_class" enctype="multipart/form-data"  onsubmit="return checkEdit(this)">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <input type="hidden" name="class_id" value="{{$single->class_id}}">
                                                                <div class="form-group">
                                                                    <label for="" class="col-sm-3 control-label">班级名称</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="" placeholder="请输入" name="class_name" value="{{$single->class_name}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="col-sm-3 control-label">专业</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" name="major_id">
                                                                            @foreach($majorArr as $major)
                                                                            <option value="{{ $major->major_id }}" @if($single->major_id == $major->major_id) selected="selected" @endif >{{ $major->major_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                            <button type="submit" class="btn btn-primary" onclick="javascript:return confirm('确定要添加吗？')">提交</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <?php echo $arr->render(); ?>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>



                <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">添加班级</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="post" action="/t_add_class" enctype="multipart/form-data"  onsubmit="return checkAdd(this)">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="type" value="1">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">班级名称</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="" placeholder="请输入" name="class_name" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">专业</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="major_id">
                                                @foreach($majorArr as $major)
                                                    <option value = "{{$major->major_id}}">{{ $major->major_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                <button type="submit" class="btn btn-primary" onclick="javascript:return confirm('确定要新增加吗？')">提交</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- /.panel -->
            </div>
            {{--{{ include('AdminBundle:Default:paging.html.twig') }}--}}
        </div>
        <!-- /.row -->
    </div>

    <script>
        function checkAdd(form) {
            if (form.class_name.value == '') {
                alert("请输入班级名称!");
                form.class_name.focus();
                return false;
            }
            if (form.major_id.value == '') {
                alert("请选择专业!");
                form.major_id.focus();
                return false;
            }
        }

        function checkEdit(form) {
            if (form.class_id.value == '') {
                alert("参数错误!");
                form.class_id.focus();
                return false;
            }
            if (form.class_name.value == '') {
                alert("请输入班级名称!");
                form.class_name.focus();
                return false;
            }
            if (form.major_id.value == '') {
                alert("请选择专业!");
                form.major_id.focus();
                return false;
            }
        }

    </script>


@stop
@section("footer")
@stop