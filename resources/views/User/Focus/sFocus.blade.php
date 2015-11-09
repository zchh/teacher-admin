@extends("User.Article.base")
@section("main")




<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>我关注的人</h2>
            <hr>


            <table class="table table-striped">
                <thead>
                    <tr>

                        <th>昵称</th>
                        <th>备注</th>
                        <th>关注日期</th>                                        
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($focusData as  $data)
                    <tr> 
                        <td>{{ $data->user_nickname }}</td>
                        <td>{{$data->relation_remark}}</td>
                        <td>{{ $data->relation_create_time }}</td>
                        <td>

                            <a href="/index_userIndex/{{$data->relation_focus}}" class="btn btn-info btn-sm" >进入Ta的主页</a>

                            <button class="btn  btn-sm btn-warning "  data-toggle="modal" data-target="#upd_{{$data->relation_id}}" type="button">修改备注</button></h2>              
                            <div class="modal fade" id="upd_{{$data->relation_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">修改备注</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/user_uFocus" method="post">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <h4>备注名称</h4>
                                                <input type="hidden" name="relation_id" value="{{$data->relation_id}}">
                                                <input type="text" id="inputText" class="form-control" name="relation_remark" placeholder="备注" value="{{$data->relation_remark}}" required autofocus> 
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn  btn-warning" type="submit">修改</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del_{{$data->relation_id}}">取消关注</button>

                            <!-- Modal -->
                            <div class="modal fade" id="del_{{$data->relation_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">将要取消关注！</h4>
                                        </div>
                                        <div class="modal-body">
                                            您确定要取消关注吗？
                                        </div>
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                            <a href="/user_dFocus/{{$data->relation_id}}" class="btn btn-danger btn-sm">确定 </a>
                                        </div>
                                    </div>
                                </div>
                            </div></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>



        </div>
    </div>
</div>

@stop
