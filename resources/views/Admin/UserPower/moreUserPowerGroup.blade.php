@extends("Admin.UserPower.base")
@section("main")

<div class="col-sm-10">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2 class="sub-header">当前权限组：{{$group_data_by_id[0]->group_name}}</h2>
            <hr>
                <div class="col-sm-4 ">
                    <table  class="table">

                        <thead>
                            <tr>
                                <th>当前权限</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($power_data_by_groupid as $power)
                            <tr>
                                <td>{{$power->power_name}}</td>
                                <td>
                                    @if($power->relation_power != null)
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del_{{$power->power_id}}">
                                        移除
                                    </button>
                                    @endif
                                    <!-- Modal -->
                                    <div class="modal fade" id="del_{{$power->power_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">警告！</h4>
                                                </div>
                                                <div class="modal-body">
                                                    将要移除该权限！
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="/admin_removePowerToUserPowerGroup/{{$group_data_by_id[0]->group_id}}/{{$power->power_id}}" class="btn btn-danger btn-sm">移除</a>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>




            <div class="col-sm-4 ">
                <table  class="table">

                    <thead>
                        <tr>
                            <th>当前用户</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user_data_by_groupid as $user)
                        <tr>
                            <td>{{$user->user_username}}</td>
                            <td>
                                @if($user->user_group != null)
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del_admin_{{$user->user_id}}">移除</button>
                                @endif
                                <div class="modal fade" id="del_admin_{{$user->user_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">警告！</h4>
                                            </div>

                                            <div class="modal-body">         
                                                <form action="/admin_removeUserToUserPowerGroup" method="post">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="user_id" value="{{$user->user_id}}">   
                                                    将要移除该用户！ 
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button  class="btn btn-danger btn-sm" type="submit">移除</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </form>



            <div class="col-sm-1 col-sm-offset-1 ">
                <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#add_power">添加权限</button>
                <div class="modal fade" id="add_power" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">请选择要添加的权限</h4>
                            </div>
                            <form action="/admin_addPowerToUserPowerGroup" method="post">
                                <div class="modal-body">            

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="group_id" value="{{$group_data_by_id[0]->group_id}}">
                                    @foreach($all_power_data as $all_power)
                                    @if(!in_array($all_power->power_id,$power_ids))
                                    <h4><input type="checkbox" name="power_id_array[]"  value="{{$all_power->power_id}}" > {{$all_power->power_id}} : {{$all_power->power_name}}</input></h4>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button  class="btn btn-primary" type="submit">添加</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <hr>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_user">添加用户</button>
                <div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">请选择要添加的用户</h4>
                            </div>
                            <form action="/admin_addUserToUserPowerGroup" method="post">
                                <div class="modal-body">                                            
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="group_id" value="{{$group_data_by_id[0]->group_id}}">
                                    @foreach($all_user_data as $all_user)
                                    @if($group_data_by_id[0]->group_id != $all_user->user_group)
                                    <h4><input type="checkbox" value="{{$all_user->user_id}}" name="user_id_array[]"> {{$all_user->user_id}} : {{$all_user->user_username}}</input></h4>  
                                    @endif
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button  class="btn btn-primary " type="submit">添加</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
        </div><!-- /.blog-sidebar -->
    </div>
</div>
</div>
</div>
</div>
@stop