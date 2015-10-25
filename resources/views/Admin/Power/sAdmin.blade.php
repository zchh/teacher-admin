@extends("Admin.Power.base")

@section("main")






        <div class="col-sm-10">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="sub-header">管理员用户 | <button class="btn  btn-primary "  data-toggle="modal" data-target="#aAdmin" type="button">添加管理员</button></h2>

                    <div class="modal fade" id="aAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">添加管理员用户</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="/_aAdmin" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <h4>管理员用户名</h4>
                                        <input type="text " id="inputText" class="form-control" name="admin_username" placeholder="Admin Username" required autofocus>

                                        <h4>管理员昵称</h4>
                                        <input type="text" id="inputText" class="form-control"  name="admin_nickname" placeholder="Admin Nickname" required autofocus>

                                        <h4>密码</h4>
                                        <input type="password" id="inputPassword" class="form-control" name="admin_password" placeholder="Admin Password" required>
                                        
                                        <h4>权限组</h4>
                                        <select class="form-control" name="admin_group">
                                            @foreach($groupData as $value)
                                            <option type="select" value="{{$value->group_id}}" selected="selected">{{$value->group_name}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-sm btn-primary" type="submit">提交</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">

                        <table class="table table-striped" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>用户名</th>
                                    <th>昵称</th>
                                    <th>所属权限组</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    foreach ($articleData as $data) {
                                        ?>
                                    <tr>
                                        <td>{{$data->admin_id}}</a></td>
                                        <td>{{$data->admin_username}}</td>
                                        <td>{{$data->admin_nickname}}</td>
                                        <td>{{$data->group_name}}</td>
                                        <td><!-- Button trigger modal -->
                                            @if($data->admin_id != 1)
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#upd_{{$data->admin_id}}">修改</button>
                                            @endif
                                            <div class="modal fade" id="upd_{{$data->admin_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">当前管理员ID：{{$data->admin_id}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="/admin_uAdmin" method="post">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <h4>请输入新的管理员用户名</h4>
                                                                <input type="hidden" name="admin_id" value="{{$data->admin_id}}">
                                                                <input type="text " id="inputText" class="form-control" name="admin_username" placeholder="Admin username" value="{{$data->admin_username}}" required autofocus>
                                                                <h4>请输入新的管理员昵称</h4>

                                                                <input type="text " id="inputText" class="form-control" name="admin_nickname" placeholder="Admin nickname" value="{{$data->admin_nickname}}" required autofocus>
                                                                <h4>请选择新的权限组</h4>

                                                                <select class="form-control" name="admin_group">
                                                                    @foreach($groupData as $value)
                                                                    <option type="select" value="{{$value->group_id}}" selected="selected">{{$value->group_name}}</option>
                                                                    @endforeach
                                                                </select>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button  class="btn btn-danger btn-sm" type="submit">提交</a>
                                                                </form>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            @if($data->admin_id != 1)
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del_{{$data->admin_id}}">删除</button>
                                            @endif
                                            <!-- Modal -->
                                            <div class="modal fade" id="del_{{$data->admin_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">警告！</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            将要删除该管理员用户！
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="/admin_dAdmin/{{$data->admin_id}}" class="btn btn-danger btn-sm">删除</a>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
            @stop