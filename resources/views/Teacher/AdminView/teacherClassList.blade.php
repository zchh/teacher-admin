@extends("Teacher.AdminView.base")
@section("content")
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">教师班级管理</h4>
                <p>教师姓名：{{ $teacher['teacher_name'] }}</p>
                <img src="/get_pic/{{ $teacher['pic_id'] }}" style="width:100%; max-width: 80px;max-height: 80px;">
                <hr>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12">
                <form  class="class=form-inline" role="form" method="post" action="">
                    <div class="form-group" >
                        <a href="" class="btn btn-ms btn-success" role="button" data-toggle="modal" data-target="#bind"><span class="glyphicon glyphicon-plus"></span>绑定班级课程</a>

                        {{--<input name="keyWords"  type="text" value="" placeholder="请输入仓库名">--}}
                        {{--<button type="submit"   class="btn btn-ms btn-primary" style="margin-left: 8px">搜索</button>--}}
                        {{--<button type="submit"   class="btn btn-ms btn-primary" style="margin-left: 8px">显示全部</button>--}}
                    </div>
                </form>
                <div class="panel panel-default">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>专业</th>
                                    <th>班级</th>
                                    <th>课程</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($arr as $single)
                                    <tr>
                                        <td >{{$single['major_name']}}</td>
                                        <td >{{$single['class']}}</td>
                                        <td >{{$single['course_name']}}</td>
                                        <td >
                                            <a href=""  data-toggle="modal" data-target="#edit_{{ $single['id'] }}" class="btn btn-xs btn-primary" data-placement="top"
                                               title="编辑"><i  class="glyphicon glyphicon-pencil"></i></a>
                                            <a href="/t_delete_teacher_class/{{ $single['id'] }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top"
                                               title="删除" onclick="javascript:return confirm('确定删除该教师班级吗？')"><i  class="fa fa-trash"></i></a>
                                        </td>


                                        <div class="modal fade" id="edit_{{ $single['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">编辑</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-horizontal">
                                                            <form class="form-horizontal" method="post" action="/t_edit_class_config" enctype="multipart/form-data"  onsubmit="return checkEdit(this)">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <input type="hidden" name="id" value="{{ $single['id'] }}">
                                                                <div class="form-group">
                                                                    <label for="" class="col-sm-3 control-label">班级</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" name="class_id">
                                                                            @foreach($classArr as $class )
                                                                                <option value = "{{ $class->class_id  }}" @if($class->class_id == $single['class_id']) selected="selected" @endif>{{ $class->class_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="col-sm-3 control-label">课程</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="" placeholder="请输入" name="course_name" value="{{ $single['course_name'] }}">
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                            <button type="submit" class="btn btn-primary" onclick="javascript:return confirm('确定要修改吗？')">提交</button>
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


                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>



                <!-- /.panel -->
            </div>





            <div class="modal fade" id="bind" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">班级绑定</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-horizontal">
                                <form class="form-horizontal" method="post" action="/t_bind_class" enctype="multipart/form-data"  onsubmit="return checkEdit(this)">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="teacher_id" value="{{ $teacher['teacher_id'] }}">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">班级</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="class_id">
                                                @foreach($classArr as $class )
                                                    <option value = "{{ $class->class_id  }}">{{ $class->class_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">课程</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="" placeholder="请输入" name="course_name" value="" required>
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





        </div>
        <!-- /.row -->
    </div>

    <script>
        function checkEdit(form) {
            if (form.id.value == '') {
                alert("参数错误!");
                form.id.focus();
                return false;
            }
            if (form.class_id.value == '') {
                alert("请选择班级!");
                form.name.focus();
                return false;
            }
            if (form.course_name.value == '') {
                alert("请输入课程名称!");
                form.course_name.focus();
                return false;
            }
        }

    </script>


@stop
@section("footer")
@stop