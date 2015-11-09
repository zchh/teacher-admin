@extends("User.Article.base")
@section("main")




<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>查看标签 | <button class="btn  btn-primary "  data-toggle="modal" data-target="#aLabel" type="button">添加标签</button></h2>              
            <div class="modal fade" id="aLabel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">添加标签</h4>
                        </div>
                        <div class="modal-body">
                            <form action="/user_aLabel" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <h4>标签名称</h4>
                                <input type="text " id="inputText" class="form-control" name="label_name" placeholder="Labelname" required autofocus>                            
                                </div>
                                <div class="modal-footer">
                                    <button class="btn  btn-primary" type="submit">添加</button>
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

                        <th>标签</th>
                        <th>创建日期</th>
                        <th>修改日期</th>                                        
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($labelData as  $data)
                    <tr> 
                        <td>{{ $data->label_name }}</td>
                        <td>{{ $data->label_create_date }}</td>
                        <td>{{ $data->label_update_date }}</td>
                        <td>



                            <button class="btn  btn-sm btn-warning "  data-toggle="modal" data-target="#upd_{{$data->label_id}}" type="button">修改</button></h2>              
                            <div class="modal fade" id="upd_{{$data->label_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">修改标签</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/user_uLabel" method="post">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <h4>标签名称</h4>
                                                <input type="hidden" name="label_id" value="{{$data->label_id}}">
                                                <input type="text" id="inputText" class="form-control" name="label_name" placeholder="Labelname" value="{{$data->label_name}}" required autofocus>                            
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn  btn-warning" type="submit">修改</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del_{{$data->label_id}}">删除</button>

                            <!-- Modal -->
                            <div class="modal fade" id="del_{{$data->label_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">警告！</h4>
                                        </div>
                                        <div class="modal-body">
                                            将要删除该标签！
                                        </div>
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                            <a href="/user_dLabel/{{$data->label_id}}" class="btn btn-danger btn-sm">删除</a>
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
