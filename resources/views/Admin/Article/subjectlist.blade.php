@extends("Admin.Article.base")
@section("main")
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">专题添加</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/admin_aSubject" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="exampleInputName" class="col-sm-2 control-label">专题名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="subject_name" name="subject_name" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">专题介绍</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="subject_intro" name="subject_intro" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">添加</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- 导航条  -->

<!-- 文本内容 -->
<div class="col-sm-10">
    <div class="panel panel-default">
        <div class="panel-body">
            <!-- Button trigger modal -->
            <div class="navbar-form navbar-right">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
                    添加专题
                </button>
            </div>
            <h2 class="sub-header">文章专题列表</h2>
           
            <hr>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>序号</th>
                            <th>专题名字</th>
                            <th>此专题文章作者</th>
                            <th>创建日期</th>
                            <th colspan="3">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subject_data as $key => $data)
                        <tr>
                            <td>{{ $data->subject_id }}</td>
                            <td>{{ $data->subject_name }}</td>
                            <td>{{ $data->subject_intro }}</td>
                            <td>{{ $data->subject_create_date }}</td>
                            <td colspan="3">
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit{{$data->subject_id}}">
                                    修改
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="edit{{$data->subject_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">专题修改</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" action="/admin_uSubject" method="post">
                                                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-2 control-label">专题ID</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="subject_id" name="subject_id" value="{{ $data->subject_id }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-2 control-label">专题名</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="subject_name" name="subject_name" value="{{ $data->subject_name }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="" class="col-sm-2 control-label">专题介绍</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="subject_intro" name="subject_intro" value="{{ $data->subject_intro }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">修改</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @if($data->recommend_id == NULL)
                                 <a class="btn btn-default btn-sm" 
                                     data-toggle="modal" data-target="#addRecommend{{$data->subject_id}}">加入推荐</a>
                                       
                                        <!-- Modal -->
                                        <div class="modal fade" id="addRecommend{{$data->subject_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">加入推荐</h4>
                                              </div>
                                              <div class="modal-body">
                                                  <form action="/admin_aRecommendSubject" method="post">
                                                  <h4>将 {{$data->subject_name}} 加入推荐？</h4>
                                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                  <input type="hidden" name="recommend_subject" value="{{$data->subject_id}}">
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                <button type="submit" class="btn btn-primary">确认</button>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                               @endif
                                <a class="btn btn-danger btn-sm" href="/admin_sSubject/{{ $data->subject_id  }}">删除</a>
                                <a class="btn btn-info btn-sm" href="/admin_moreSubject/{{ $data->subject_id }}">详情页</a>
                            </td>
                            <!--<td><a href="/admin_sSubject/{{ $data->subject_id  }}">Delete</a></td>
                            <td><a class="btn btn-info" href="/admin_moreSubject/{{ $data->subject_id }}">详情页</a></td>-->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- 分页 -->
        </div>
    </div>
</div>
@stop
