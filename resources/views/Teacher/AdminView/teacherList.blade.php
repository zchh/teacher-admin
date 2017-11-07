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
                    <a href="" class="btn btn-ms btn-success" role="button"><span class="glyphicon glyphicon-plus"></span>整体发放优惠券</a>



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

            <!-- /.panel -->
        </div>
        {{--{{ include('AdminBundle:Default:paging.html.twig') }}--}}
    </div>
    <!-- /.row -->
</div>
@stop
@section("footer")
@stop