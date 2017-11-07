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
                            @foreach($teachers as $single)
                            <tr>
                                <td >{{$single->teacher_id}}</td>
                                <td >{{$single->pic}}</td>
                                <td >{{$single->name}}</td>
                                <td >{{$single->id_number}}</td>
                                <td >{{$single->sex}}</td>
                                <td >{{$single->user_name}}</td>
                                <td >{{$single->cteate_time}}</td>
                                <td >
                                    sss
                                    {{--<a href="{{ path('admin_warehouse_worker',{'id':entity.id}) }}" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top"--}}
                                       {{--title="仓库人员"><i  class="fa fa-hand-o-right"></i></a>--}}
                                    {{--<a href="{{ path('look_goods_manager',{'id':entity.id}) }}" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top"--}}
                                       {{--title="仓库商品"><i  class="fa fa-bars"></i></a>--}}
                                    {{--<a href="{{ path("del_warehouse",{'id':entity.id, 'page':pageInfo.currentPage, 'param': pageInfo.param}) }}" onclick="javascript:return confirm('确定删除该仓库吗？')"--}}
                                       {{--data-method="delete" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="删除"><i class="fa fa-trash">删除</i></a>--}}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
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
                            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
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
                                        <input type="text" class="form-control" id="" placeholder="请输入" name="admin_name" value="">
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
@stop
@section("footer")
@stop