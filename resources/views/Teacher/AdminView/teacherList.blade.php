@extends("Teacher.AdminView.base")
@section("content")
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">教师管理</h4>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-12">
            <form  class="class=form-inline" role="form" method="post" action="">
                <div class="form-group" >
                    <a href="" class="btn btn-ms btn-success" role="button" data-toggle="modal" data-target="#new"><span class="glyphicon glyphicon-plus"></span>添加教师</a>



                    <input name="keyWords"  type="text" value="" placeholder="">
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
                                <th>头像</th>
                                <th>教师名字</th>
                                <th>身份证号</th>
                                <th>性别</th>
                                <th>用户名</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($arr as $single)
                            <tr>
                                <td >{{$single->teacher_id}}</td>
                                <td >
                                    <img src="/get_pic/{{$single->pic_id}}" style="width:100%; max-width: 80px;max-height: 80px;">
                                </td>
                                <td >{{$single->name}}</td>
                                <td >{{$single->id_number}}</td>
                                <td >
                                    @if($single->sex == '1')
                                     男
                                    @else
                                     女
                                    @endif
                                </td>
                                <td >{{$single->user_name}}</td>
                                <td >{{$single->create_time}}</td>
                                <td >
                                    <a href=""  data-toggle="modal" data-target="#edit_{{ $single->teacher_id }}" class="btn btn-xs btn-primary" data-placement="top"
                                       title="编辑"><i  class="glyphicon glyphicon-pencil"></i></a>
                                    <a href="/t_delete_teacher/{{$single->teacher_id}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top"
                                       title="删除" onclick="javascript:return confirm('确定删除该专教师吗？')"><i  class="fa fa-trash"></i></a>
                                </td>


                                <div class="modal fade" id="edit_{{ $single->teacher_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">编辑</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-horizontal">
                                                    <form class="form-horizontal" method="post" action="/t_edit_teacher" enctype="multipart/form-data"  onsubmit="return checkEdit(this)">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="teacher_id" value="{{$single->teacher_id}}">
                                                        <div class="form-group">
                                                            <label for="" class="col-sm-3 control-label">头像</label>
                                                            <div class="col-sm-9">
                                                                <img src="/get_pic/{{$single->pic_id}}" style="width:100%; max-width: 80px;max-height: 80px;">
                                                                <input type="file" class="form-control" id="" placeholder="请输入" name="pic" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="" class="col-sm-3 control-label">教师姓名</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" id="" placeholder="请输入" name="name" value="{{$single->name}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="" class="col-sm-3 control-label">身份证号</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" id="" placeholder="请输入" name="id_number" value="{{$single->id_number}}">
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
                                                            <label for="" class="col-sm-3 control-label">用户名</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" id="" placeholder="请输入" name="user_name" value="{{ $single->user_name }}">
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
                            <h4 class="modal-title" id="myModalLabel">添加教师</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="post" action="/t_add_teacher" enctype="multipart/form-data"  onsubmit="return checkAdd(this)">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="type" value="1">
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">头像</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" id="" placeholder="请输入" name="pic" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">教师姓名</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="" placeholder="请输入" name="name" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">身份证号</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="" placeholder="请输入" name="id_number" value="">
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
                                    <label for="" class="col-sm-3 control-label">用户名</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="" placeholder="请输入" name="user_name" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">密码</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="" placeholder="请输入" name="password" value="">
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
            alert("请输入教师姓名!");
            form.name.focus();
            return false;
        }
        if (form.id_number.value == '') {
            alert("请输入身份证号!");
            form.id_number.focus();
            return false;
        }
        if (form.sex.value == '') {
            alert("请输入性别!");
            form.sex.focus();
            return false;
        }
        if (form.user_name.value == '') {
            alert("请输入用户名!");
            form.user_name.focus();
            return false;
        }
        if (form.password.value == '') {
            alert("请输入密码!");
            form.password.focus();
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
            alert("请输入教师姓名!");
            form.name.focus();
            return false;
        }
        if (form.id_number.value == '') {
            alert("请输入身份证号!");
            form.id_number.focus();
            return false;
        }
        if (form.sex.value == '') {
            alert("请输入性别!");
            form.sex.focus();
            return false;
        }
        if (form.user_name.value == '') {
            alert("请输入用户名!");
            form.user_name.focus();
            return false;
        }
    }

</script>


@stop
@section("footer")
@stop