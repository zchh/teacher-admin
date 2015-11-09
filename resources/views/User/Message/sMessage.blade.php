 @extends("User.Message.base")
@section("main")


<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>查看消息箱</h2>
            <hr/>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>消息标题</th>
                        <th>消息创建时期</th>
                        <th>消息接收者</th>
                        <th>消息内容</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($base_message as $single)   
                    @if ($send_user == $single -> message_send_user)
                    <tr>
                        <td>{{$single -> message_title}}</td>
                        <td>{{$single -> message_create_date}}</td>
                        <td>{{$single -> user_username }}</td>
                          <td>
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#select_{{$single -> message_id}}">
                               查看详情
                            </button>
                            </td>
                        <td>

                            <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#delete_{{$single -> message_id}}">
                                删除
                            </button>


                            <!-- Button trigger modal -->

                            <!-- Modal -->
                            <div class="modal fade" id="delete_{{$single -> message_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">删除消息</h4>
                                        </div>
                                        <div class="modal-body">
                                            确定要删除吗？               
                                        </div>
                                        <div class="modal-footer">
                                            <a href="/user_dMessage/{{$single -> message_id}}" class="btn btn-danger" name="delete">确定删除</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                                 <div class="modal fade" id="select_{{$single -> message_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">消息内容详情</h4>
                                        </div>
                                        <div class="modal-body">
                                              <blockquote>
                                                   <p>{{$single -> message_data}}</p>
                                                  </blockquote>          
                                        </div>
                                        <div class="modal-footer">
                                           

                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            

                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>


        </div></div></div>

<div class="col-sm-2">
    <div class="panel panel-default">
        <div class="panel-body">
            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#add">
                添加
            </button>


            <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><h1>添加消息信息</h1></h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="/user_aMessage">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label for="exampleInputFile">消息接收者</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="message_recv_user">
                                    <label for="exampleInputFile">消息标题</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="message_title">
                                    <label for="exampleInputFile">消息内容</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="message_data">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default">提交</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-sm-8 col-md-offset-2" >
    <?php echo $base_message->render(); ?>  

</div>


@stop

