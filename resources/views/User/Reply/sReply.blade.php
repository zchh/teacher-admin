@extends("User.Reply.base")
@section("main")


<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>查看评论</h2>
            <hr/>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>用户</th>
                        <th>创建日期</th>
                        <th>评论文章</th>
                        <th>评论内容</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reply_data as $data)
                    <tr>
                        <td>{{$data->reply_id}}</td>
                        <td>{{$data->user_username}}</td>
                        <td>{{$data->reply_create_date}}</td>
                        <td>{{$data->article_title}}</td>
                        <td>{{$data->reply_detail}}</td>
                        <td>

                            <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#delete_{{$data->reply_id}}">
                                删除
                            </button>
                            <!-- Button trigger modal -->

                            <!-- Modal -->
                            <div class="modal fade" id="delete_{{$data->reply_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">删除类别</h4>
                                        </div>
                                        <div class="modal-body">
                                            确定要删除吗？               
                                        </div>
                                        <div class="modal-footer">
                                            <a href="/user_dReply/{{$data->reply_id}}" class="btn btn-danger" name="delete">确定删除</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


        </div></div></div>

<div class="col-sm-8 col-md-offset-2" >
    <?php echo $reply_data->render(); ?>  
</div>

@stop









