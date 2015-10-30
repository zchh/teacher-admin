@extends("User.Article.base")
@section("main")




<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>查看专题 | <button class="btn  btn-primary "  data-toggle="modal" data-target="#aSubject" type="button">添加专题</button></h2>              
            <div class="modal fade" id="aSubject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">添加专题</h4>
                        </div>
                        <div class="modal-body">
                            <form action="/user_aSubject" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <h4>专题名称</h4>
                                <input type="text " id="inputText" class="form-control" name="subject_name" placeholder="Subjectname" required autofocus>
                                 <h4>专题介绍</h4>
                                <input type="text " id="inputText" class="form-control" name="subject_intro" placeholder="Subjectintro" required autofocus>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn  btn-primary" type="submit">提交</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div></h2>
            <hr>


            <table class="table table-striped">
                <thead>
                    <tr>

                        <th>专题</th>
                        <th>创建日期</th>
                        <th>修改日期</th>                                        
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjectData as  $data)
                    <tr> 
                        <td>{{ $data->subject_name }}</td>
                        <td>{{ $data->subject_create_date }}</td>
                        <td>{{ $data->subject_update_date }}</td>
                        <td>

                            <a href="/user_moreSubject/{{$data->subject_id}}" class="btn btn-info btn-sm" >详情</a>

                            <button class="btn  btn-sm btn-warning "  data-toggle="modal" data-target="#upd_{{$data->subject_id}}" type="button">修改</button></h2>              
                            <div class="modal fade" id="upd_{{$data->subject_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">修改专题</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/user_uSubject" method="post">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <h4>专题名称</h4>
                                                <input type="hidden" name="subject_id" value="{{$data->subject_id}}">
                                                <input type="text" id="inputText" class="form-control" name="subject_name" placeholder="Subjectname" value="{{$data->subject_name}}" required autofocus> 
                                                <h4>专题介绍</h4>
                                                <input type="hidden" name="subject_id" value="{{$data->subject_id}}">
                                                <input type="text" id="inputText" class="form-control" name="subject_intro" placeholder="Subjectintro" value="{{$data->subject_intro}}" required autofocus> 
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn  btn-warning" type="submit">修改</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del_{{$data->subject_id}}">删除</button>

                            <!-- Modal -->
                            <div class="modal fade" id="del_{{$data->subject_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">警告！</h4>
                                        </div>
                                        <div class="modal-body">
                                            将要删除该专题！
                                        </div>
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                            <a href="/user_dSubject/{{$data->subject_id}}" class="btn btn-danger btn-sm">删除</a>
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
