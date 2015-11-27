@extends("Index.base")
@section("main")
<div class="col-sm-6 col-sm-offset-3">
    <div class="panel panel-default">
        <div class="panel-body">
            <div id='back'class="col-sm-12">
                <div class="col-sm-12">
                    <h2 style="text-align:center">
                        用户注册
                    </h2> <hr/>
                </div>
                <div class="col-sm-12" >
                    <form id="form_register">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label>用户名：</label>
                           
                                <input type="text" name="user_username" class="form-control required" minlength="2" id="user_username" placeholder="用户名">
                            
                        </div>
                        <div class="form-group">
                            <label >昵称：</label>
                           
                                <input type="text" name="user_nickname" class="form-control required" minlength="2" id="user_nickname" placeholder="用户昵称">
                            
                        </div>
                        <div class="form-group">
                            <label>密码：</label>
                           
                                <input type="password" name="user_password" class="form-control" id="user_password" placeholder="Password">
                            
                        </div>
                        <div class="form-group">
                            <label>性别：</label>
                            
                                <input type="radio" name="user_sex" id="user_sex" value="男" aria-label="...">男
                               
                                <input type="radio" name="user_sex" id="user_sex" value="女" aria-label="...">女
                            
                        </div>
                        <div class="form-group">
                            <label>介绍：</label>
                            
                                <textarea name="user_intro" id="user_intro" class="form-control" rows="3" placeholder="用户介绍"></textarea>
                           
                        </div>
                        <div class="form-group">
                            <label>邮箱：</label>
                           
                                <input type="text" name="user_email" class="form-control" id="user_email" placeholder="邮箱">
                           
                        </div>
                        <div class="col-sm-12" style="text-align:center">
                            <a id="sub" class="btn btn-default btn-sm">提交</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="kuang" class="panel panel-default">
        <div class="panel-body">
            <div id="sss" class="text-muted" style="text-align: center;font-family: 微软雅黑;"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $("#kuang").hide(50);
        $("#sub").click(function() {
            $("#sub").hide();
            $("#sss").html("<p style='font-size:18px;font-family:微软雅黑;text-align:center'>已发送注册信息，马上就好</p>");
            $("#kuang").show(1000);
            $.ajax({
                'type': 'post',
                'url': "/_user_register",
                'data': {
                    "user_username": $("#user_username").val(),
                    "user_nickname": $("#user_nickname").val(),
                    "user_password": $("#user_password").val(),
                    "user_sex": $("#user_sex").val(),
                    "user_intro": $("#user_intro").val(),
                    "user_email": $("#user_email").val()
                },
                'success': function(msg) {
                    if (msg.status == true)
                    {
                        //$("#kuang").show(500);
                        $("#sss").html(msg.message);
                        
                        setTimeout('window.location = "/user_login";', 1000);
                    }
                    else
                    {
                        //$("#kuang").show(500);
                        $("#sss").html(msg.message);
                        $("#sub").show(50);
                    }
                }
            });
        });
    });
</script>
@stop
