

<div class="panel panel-default">
    <div class="panel-body">
        <img src="/getImage/{{$userData->image_id}}" class="text-center img-circle img-responsive" style="width:80%;height:100%;left: 10%;position:relative">
        <hr/>
        <h4 style='margin: auto'>{{$userData->user_nickname}}</h4>
        <hr>
        <small>{{$userData->user_intro}}</small>
        <hr>
        <a  class="btn btn-default btn-sm" href="/index_userIndex/{{$userData->user_id}}" aria-label="Left Align">
            <span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span>  个人主页
        </a> 
        @if(  session("user.user_status")!=false)
         @if($userData->relation_focus==$userData->user_id )
        <button class="btn btn-default btn-sm"  data-toggle="modal" data-target="#del_{{$userData->relation_id}}" aria-label="Left Align" >取消关注</button>
        <!-- Modal -->
        <div class="modal fade" id="del_{{$userData->relation_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <a href="/user_dFocus/{{$userData->relation_id}}" class="btn btn-danger btn-sm">确定 </a>
                    </div>
                </div>
            </div>
        </div>
        @else
        <button class="btn btn-default btn-sm"  data-toggle="modal" data-target="#aFocus" aria-label="Left Align" ><span class="glyphicon glyphicon-heart" aria-hidden="true"></span> 关注</button>          
        <div class="modal fade" id="aFocus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">添加备注</h4>
                    </div>
                    <div class="modal-body">
                        <form action="/user_aFocus" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="relation_focus" value="{{ $userData->user_id }}">

                            <input type="text " id="inputText" class="form-control" name="relation_remark" placeholder="备注名称" value="{{$userData->user_nickname}}" required autofocus>                            
                            </div>
                            <div class="modal-footer">
                                <button class="btn  btn-primary" type="submit">提交</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @endif
        @endif
    </div>
</div>


