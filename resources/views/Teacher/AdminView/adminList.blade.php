@extends("Teacher.AdminView.base")
@section("content")
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">普通管理员管理</h4>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12">
                <form  class="class=form-inline" role="form" method="post" action="">
                    <div class="form-group" >
                        <a href="" class="btn btn-ms btn-success" role="button" data-toggle="modal" data-target="#new"><span class="glyphicon glyphicon-plus"></span>添加管理员</a>
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
                                    <th>姓名</th>
                                    <th>编号</th>
                                    <th>身份证号</th>
                                    <th>用户名</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($arr as $single)
                                    <tr>
                                        <td >{{$single->id}}</td>
                                        <td >
                                            <img src="/get_pic/{{$single->pic_id}}" style="width:100%; max-width: 80px;max-height: 80px;">
                                        </td>
                                        <td >{{$single->name}}</td>
                                        <td >{{$single->number}}</td>
                                        <td >{{$single->id_number}}</td>
                                        <td >{{$single->admin_name}}</td>
                                        <td >{{$single->create_time}}</td>
                                        <td >
                                            <a href=""  data-toggle="modal" data-target="#edit_{{ $single->id }}" class="btn btn-xs btn-primary" data-placement="top"
                                               title="编辑"><i  class="glyphicon glyphicon-pencil"></i></a>
                                            <a href="/t_delete_admin/{{$single->id}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top"
                                               title="删除" onclick="javascript:return confirm('确定删除该管理员吗？')"><i  class="fa fa-trash"></i></a>
                                        </td>


                                        <div class="modal fade" id="edit_{{ $single->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">编辑</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-horizontal">
                                                            <form class="form-horizontal" method="post" action="/t_edit_admin" enctype="multipart/form-data"  onsubmit="return checkEdit(this)">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <input type="hidden" name="id" value="{{$single->id}}">
                                                                <div class="form-group">
                                                                    <label for="" class="col-sm-3 control-label">头像</label>
                                                                    <div class="col-sm-9">
                                                                        <img src="/get_pic/{{$single->pic_id}}" style="width:100%; max-width: 80px;max-height: 80px;">
                                                                        <input type="file" class="form-control" id="" placeholder="请输入" name="pic" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="col-sm-3 control-label">姓名</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="" placeholder="请输入" name="name" value="{{$single->name}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="col-sm-3 control-label">用户名</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="" placeholder="请输入" name="admin_name" value="{{$single->admin_name}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="col-sm-3 control-label">编号</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="" placeholder="请输入" name="number" value="{{$single->number}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="col-sm-3 control-label">身份证号</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="" placeholder="请输入" name="id_number" value="{{$single->id_number}}">
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
                                <form class="form-horizontal" method="post" action="/t_add_admin" enctype="multipart/form-data"  onsubmit="return checkAdd(this)">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                                        <label for="" class="col-sm-3 control-label">用户名</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="" placeholder="请输入" name="admin_name" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">编号</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="" placeholder="请输入" name="number" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">身份证号</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="" placeholder="请输入" name="id_number" value="">
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
            if (form.admin_name.value == '') {
                alert("请输入管理员用户名!");
                form.admin_name.focus();
                return false;
            }
            if (form.number.value == '') {
                alert("请输入编号!");
                form.number.focus();
                return false;
            }
            if (form.id_number.value == '') {
                alert("请输入身份证号!");
                form.id_number.focus();
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
            if (form.admin_name.value == '') {
                alert("请输入管理员用户名!");
                form.admin_name.focus();
                return false;
            }
            if (form.number.value == '') {
                alert("请输入编号!");
                form.number.focus();
                return false;
            }
            if (form.id_number.value == '') {
                alert("请输入身份证号!");
                form.id_number.focus();
                return false;
            }
        }

    </script>


@stop
@section("footer")
@stop