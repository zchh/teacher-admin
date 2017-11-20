@extends("Teacher.AdminView.base")
@section("content")
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">专业管理</h4>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12">
                <form  class="class=form-inline" role="form" method="post" action="">
                    <div class="form-group" >
                        <a href="" class="btn btn-ms btn-success" role="button" data-toggle="modal" data-target="#new"><span class="glyphicon glyphicon-plus"></span>添加专业</a>

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
                                    <th>专业名称</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($arr as $single)
                                    <tr>
                                        <td >{{$single->major_id}}</td>
                                        <td>{{$single->major_name}}</td>
                                        <td >
                                            <a href=""  data-toggle="modal" data-target="#edit_{{ $single->major_id }}" class="btn btn-xs btn-primary" data-placement="top"
                                               title="编辑"><i  class="glyphicon glyphicon-pencil"></i></a>
                                            <a href="/t_delete_major/{{$single->major_id}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top"
                                               title="删除" onclick="javascript:return confirm('确定删除该专业吗？')"><i  class="fa fa-trash"></i></a>
                                        </td>


                                        <div class="modal fade" id="edit_{{ $single->major_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">编辑专业</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-horizontal">
                                                            <form class="form-horizontal" method="post" action="/t_edit_major" enctype="multipart/form-data"  onsubmit="return checkEdit(this)">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <input type="hidden" name="major_id" value="{{$single->major_id}}">
                                                                <div class="form-group">
                                                                    <label for="" class="col-sm-3 control-label">专业名称</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="" placeholder="请输入" name="major_name" value="{{$single->major_name}}">
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
                                <h4 class="modal-title" id="myModalLabel">添加专业</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="post" action="/t_add_major" enctype="multipart/form-data"  onsubmit="return checkAdd(this)">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">专业名称</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="" placeholder="请输入" name="major_name" value="">
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
            if (form.major_name.value == '') {
                alert("请输入专业名称");
                form.major_name.focus();
                return false;
            }
        }

        function checkEdit(form) {
            if (form.major_id.value == '') {
                alert("参数错误!");
                form.major_id.focus();
                return false;
            }
            if (form.major_name.value == '') {
                alert("请输入专业名称");
                form.major_name.focus();
                return false;
            }
        }

    </script>


@stop
@section("footer")
@stop