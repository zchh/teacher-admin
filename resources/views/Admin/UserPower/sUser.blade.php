@extends("Admin.UserPower.base")
@section("main")

<div class="col-sm-10">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2 class="sub-header">用户 | <button class="btn  btn-primary "  data-toggle="modal" data-target="#aAdmin" type="button">添加用户</button></h2>

            <div class="modal fade" id="aAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">添加用户</h4>
                        </div>
                        <div class="modal-body">
                            <form action="/admin_aUser" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <h4>用户名</h4>
                                <input type="text " id="inputText" class="form-control" name="user_username" placeholder="User Username" required autofocus>

                                <h4>用户昵称</h4>
                                <input type="text" id="inputText" class="form-control"  name="user_nickname" placeholder="User Nickname" required autofocus>

                                <h4>密码</h4>
                                <input type="password" id="inputPassword" class="form-control" name="user_password" placeholder="User Password" required>

                                <h4>权限组</h4>
                                <select class="form-control" name="user_group">
                                    @foreach($group_data as $group1)
                                    <option type="select" value="{{$group1->group_id}}">{{$group1->group_name}}</option>
                                    @endforeach
                                </select>
                                <div class="modal-footer">
                                    <button class="btn btn-sm btn-primary" type="submit">提交</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">

                <table class="table table-striped" class="table table-hover">
                    <thead>
                        <tr>
                            <th>用户ID</th>
                            <th>用户名</th>
                            <th>昵称</th>
                            <th>所属权限组</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user_data as $data)
                            <tr>
                                <td>{{$data->user_id}}</a></td>
                                <td>{{$data->user_username}}</td>
                                <td>{{$data->user_nickname}}</td>
                                <td>{{$data->group_name}}</td>
                                <td><!-- Button trigger modal -->
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#upd_{{$data->user_id}}">修改</button>
                                    <div class="modal fade" id="upd_{{$data->user_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">当前用户ID：</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/admin_uUser" method="post">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <h4>当前用户名</h4>
                                                        <input type="hidden" name="user_id" value="{{$data->user_id}}">
                                                        <input type="text " id="inputText" class="form-control" name="user_username" placeholder="user username" value="{{$data->user_username}}" required autofocus>
                                                        <h4>当前用户昵称</h4>

                                                        <input type="text " id="inputText" class="form-control" name="user_nickname" placeholder="user nickname" value="{{$data->user_nickname}}" required autofocus>
                                                        <h4>请选择新的权限组</h4>

                                                        <select class="form-control" name="user_group">
                                                            @foreach($group_data as $group)
                                                            @if($group->group_id != $data->user_group)
                                                            <option type="select" value="{{$group->group_id}}">{{$group->group_name}}</option>
                                                            @else
                                                            <option type="select" value="{{$group->group_id}}" selected="selected">{{$group->group_name}}</option>
                                                            @endif
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



                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del_{{$data->user_id}}">删除</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="del_{{$data->user_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">警告！</h4>
                                                </div>
                                                <div class="modal-body">
                                                    将要删除该用户！
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="/admin_dUser/{{$data->user_id}}" class="btn btn-danger btn-sm">删除</a>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>

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