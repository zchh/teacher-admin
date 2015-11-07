@extends("User.PersonalMessage.base")
@section("main")

<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-body">

            <form action="/_user_uPersonalMessage" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                <div class="col-sm-6 form-group">
                    <label>昵称</label>
                    <input type="text" class="form-control"  name="user_nickname" value="{{ $personalMessage->user_nickname}}">
                </div>
                <div class="col-sm-6 form-group">
                    <label>性别</label>
                    <select class="form-control" name="user_sex" value="{{ $personalMessage->user_nickname}}">
                        <option>男</option>
                        <option>女</option>
                    </select>
                </div>
                <div class="col-sm-6 form-group">
                    <label >密码</label>
                    <input type="text" class="form-control"  name="user_password" value="{{ $personalMessage->user_password}}">
                </div>
                <div class="col-sm-6 form-group">
                    <label>年龄</label>
                    <input type="text" class="form-control"name="user_age" value="{{ $personalMessage->user_age}}">

                </div>
                <div class="col-sm-6 form-group">
                    <label>简介</label>
                    <textarea class="form-control" rows="2" name="user_intro">{{ $personalMessage->user_intro}}</textarea>
                </div>

                <div class="col-sm-12 form-group">
                    <a type="button" class="btn btn-default" data-toggle="modal" data-target="#change_">
                        选择头像
                    </a>                  
                </div>


                <!-- Modal -->
                <div class="modal fade" id="change_" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">选择头像</h4>
                            </div>
                            <div class="modal-body">
                                <iframe src="/user_sImageInFrame" noresize="noresize" style="width:100%;height:500px" frameborder="0"></iframe>                    
                            </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-sm-12 form-group" >
                    <input type="submit" class="btn btn-default" value="提交">
                </div>

            </form>




        </div>   
    </div>
</div>




@stop

