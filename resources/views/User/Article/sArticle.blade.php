@extends("User.Article.base")
@section("main")
    
  


        <div class="col-sm-8">
            <div class="panel panel-default">
                     <div class="panel-body">
                         <h2>查看文章</h2>
                         <hr/>


                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>文章标题</th>
                                        <th>创建日期</th>
                                        <th>更改日期</th>
                                        <th>类别</th>
                                        <th>隶属专题</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($articleData as  $data)
                                    <tr>
                                        <td>{{ $data->article_id}}</td>
                                        <td>{{ $data->article_title }}</td>
                                        <td>{{ $data->article_create_date }}</td>
                                        <td>{{ $data->article_update_date }}</td>
                                        <td>{{ $data->article_class }}</td>
                                        <td>x</td>


                                        <td>
                                            <a href="/user_uArticle/{{$data->article_id}}" class="btn btn-default">修改</a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del_{{$data->article_id}}">
                                               删除
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="del_{{$data->article_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">删除</h4>
                                                        </div>
                                                        <form class="form-horizontal" action="/admin_AddArticleToSubject" method="post">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <div class="modal-body">
                                                                <h3>确定要删除吗？</h3>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                                                <a type="button" class="btn btn-danger" href="/user_dArticle/{{$data->article_id}}">确定</a>
                                                            </div>
                                                        </form>
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
