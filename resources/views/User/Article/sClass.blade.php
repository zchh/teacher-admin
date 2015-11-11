@extends("User.Article.base")
@section("main")


<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>查看类别</h2>
            <hr/>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                    
                        <th>创建日期</th>
                        <th>更改日期</th>
                        <th>类名</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($userArticleClass as $articleClass)   
                    @if ($userId == $articleClass -> class_user)
                    <tr>
                        <td>{{$articleClass -> class_id}}</td>
                        
                        <td>{{$articleClass -> class_create_date}}</td>
                        <td>{{$articleClass -> class_update_date}}</td>
                        <td>{{$articleClass -> class_name}}</td>
                        <td>

                            <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#delete_{{$articleClass -> class_id}}">
                                删除
                            </button>
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#update_{{$articleClass -> class_id}}">
                                修改
                            </button>






                            <!-- Button trigger modal -->

                            <!-- Modal -->
                            <div class="modal fade" id="delete_{{$articleClass -> class_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                            <a href="/user_dClass/{{$articleClass -> class_id}}" class="btn btn-danger" name="delete">确定删除</a>

                                        </div>
                                    </div>
                                </div>
                            </div>




                            <!-- Button trigger modal -->

                            <!-- Modal -->
                            <div class="modal fade" id="update_{{$articleClass -> class_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">修改类别</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="/user_uClass">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">类名</label>
                                                    <input type="text" class="form-control" id="exampleInputPassword1" name="class_name" value="{{$articleClass -> class_name}}">
                                                    <input type="hidden" value="{{$articleClass -> class_id}}" name="class_id">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-default">提交</button>
                                            </form>
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
 <?php echo $userArticleClass->render(); ?>  

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
                            <h4 class="modal-title" id="myModalLabel"><h1>添加类别</h1></h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="/user_aClass">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label for="exampleInputFile">类名</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="class_name">
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


@stop









