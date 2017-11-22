@extends("Teacher.AdminView.base")
@section("content")
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">学生管理</h4>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12">
                <form  class="class=form-inline" role="form" method="post" action="">
                    <div class="form-group" >
                        <a href="" class="btn btn-ms btn-success" role="button" data-toggle="modal" data-target="#new"><span class="glyphicon glyphicon-plus"></span>添加学生</a>

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
                                    <th>ID</th>
                                    <th>头像</th>
                                    <th>学生姓名</th>
                                    <th>学号</th>
                                    <th>性别</th>
                                    <th>所在班级</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($arr as $single)
                                    <tr>
                                        <td style="vertical-align:middle">{{$single->student_id}}</td>
                                        <td style="vertical-align:middle">
                                            <img src="/get_pic/{{$single->pic_id}}" style="width:100%; max-width: 80px;max-height: 80px;">
                                        </td>
                                        <td style="vertical-align:middle">{{$single->name}}</td>
                                        <td style="vertical-align:middle">{{$single->student_number}}</td>
                                        <td style="vertical-align:middle">
                                            @if($single->sex == '1')
                                                男
                                            @else
                                                女
                                            @endif
                                        </td>
                                        <td style="vertical-align:middle">
                                            @foreach($classArr as $class)
                                            @if($class->class_id == $single->class_id)
                                            {{ $class->class_name }}
                                            @endif
                                            @endforeach
                                        </td>
                                        <td style="vertical-align:middle">{{$single->create_time}}</td>
                                        <td style="vertical-align:middle">
                                            <a href=""  data-toggle="modal" data-target="#edit_{{ $single->student_id }}" class="btn btn-xs btn-primary" data-placement="top"
                                               title="编辑"><i  class="glyphicon glyphicon-pencil"></i></a>
                                            <a href="/t_delete_student/{{$single->student_id}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top"
                                               title="删除" onclick="javascript:return confirm('确定删除该专学生吗？')"><i  class="fa fa-trash"></i></a>
                                        </td>


                                        <div class="modal fade" id="edit_{{ $single->student_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">编辑</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-horizontal">
                                                            <form class="form-horizontal" method="post" action="/t_edit_student" enctype="multipart/form-data"  onsubmit="return checkEdit(this)">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <input type="hidden" name="student_id" value="{{$single->student_id}}">
                                                                <div class="form-group">
                                                                    <label for="" class="col-sm-3 control-label">头像</label>
                                                                    <div class="col-sm-9">
                                                                        <img src="/get_pic/{{$single->pic_id}}" style="width:100%; max-width: 80px;max-height: 80px;">
                                                                        <input type="file" class="form-control" id="" placeholder="请输入" name="pic" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="col-sm-3 control-label">学生姓名</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="" placeholder="请输入" name="name" value="{{$single->name}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="col-sm-3 control-label">学号</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="" placeholder="请输入" name="student_number" value="{{$single->student_number}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="col-sm-3 control-label">性别</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" name="sex">
                                                                            <option value = "1"  @if($single->sex == '1') selected="selected"  @endif>男</option>
                                                                            <option value = "2"  @if($single->sex == '2') selected="selected" @endif>女</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="col-sm-3 control-label">所在班级</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" name="class_id">
                                                                        @foreach($classArr as $class)
                                                                            <option value = "{{ $class->class_id }}"  @if($single->class_id ==  $class->class_id) selected="selected"  @endif>
                                                                              {{ $class->class_name }}
                                                                            </option>
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
                                <h4 class="modal-title" id="myModalLabel">添加学生</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="post" action="/t_add_student" enctype="multipart/form-data"  onsubmit="return checkAdd(this)">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="type" value="1">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">头像</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" id="" placeholder="请输入" name="pic" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">姓名</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="" placeholder="请输入" name="name" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">学号</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="" placeholder="请输入" name="student_number" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">性别</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="sex">
                                                <option value = "1">男</option>
                                                <option value = "2">女</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">所在班级</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="class_id">
                                            @foreach($classArr as $class)
                                                <option value = "{{ $class->class_id }}" selected="selected">{{ $class->class_name }}</option>
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
            if (form.pic.value == '') {
                alert("请输入头像!");
                form.pic.focus();
                return false;
            }
            if (form.name.value == '') {
                alert("请输入学生姓名!");
                form.name.focus();
                return false;
            }
            if (form.student_number.value == '') {
                alert("请输入学号!");
                form.student_number.focus();
                return false;
            }
            if (form.sex.value == '') {
                alert("请输入性别!");
                form.sex.focus();
                return false;
            }
            if (form.class_id.value == '') {
                alert("请选择所在班级!");
                form.class_id.focus();
                return false;
            }
        }

        function checkEdit(form) {
            if (form.id.value == '') {
                alert("参数错误!");
                form.id.focus();
                return false;
            }
            if (form.name.value == '') {
                alert("请输入学生姓名!");
                form.name.focus();
                return false;
            }
            if (form.student_number.value == '') {
                alert("请输入学号!");
                form.student_number.focus();
                return false;
            }
            if (form.sex.value == '') {
                alert("请输入性别!");
                form.sex.focus();
                return false;
            }
            if (form.class_id.value == '') {
                alert("请选择所在班级!");
                form.class_id.focus();
                return false;
            }
        }

    </script>


@stop
@section("footer")
@stop