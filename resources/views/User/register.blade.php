@extends("Index.base")
@section("main")
<style>
    #back{
        background-image: url('/image/5.jpg');
    }
</style>
<div class="col-sm-6 col-sm-offset-3">
    <div class="panel panel-default">
        <div class="panel-body">
            <div id='back'class="col-sm-12">
                <div class="col-sm-12">
                    <h2 style="text-align:center">
                        用户注册
                    </h2> <hr/>
                </div>
                <div class="col-sm-12" style="text-align: center">
                    <form id="form_register" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-2 control-label" style="text-align: center;font-family: 微软雅黑;color: #646464">用户名：</label>
                            <div class="col-sm-8">
                                <input type="text" name="user_username" class="form-control" id="user_username" placeholder="用户名">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-2 control-label" style="text-align: center;font-family: 微软雅黑;color: #646464">昵 &nbsp;&nbsp;称：</label>
                            <div class="col-sm-8">
                                <input type="text" name="user_nickname" class="form-control" id="user_nickname" placeholder="用户昵称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-2 control-label" style="text-align: center;font-family: 微软雅黑;color: #646464">密 &nbsp;&nbsp;码：</label>
                            <div class="col-sm-8">
                                <input type="password" name="user_password" class="form-control" id="user_password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-2 control-label" style="text-align: center;font-family: 微软雅黑;color: #646464">性 &nbsp;&nbsp;别：</label>
                            <div class="col-sm-8">
                                <input type="radio" name="user_sex" id="user_sex" value="男" aria-label="...">男
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="user_sex" id="user_sex" value="女" aria-label="...">女
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-2 control-label" style="text-align: center;font-family: 微软雅黑;color: #646464">介 &nbsp;&nbsp;绍：</label>
                            <div class="col-sm-8">
                                <textarea name="user_intro" class="form-control" rows="3" placeholder="用户介绍"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-2 control-label" style="text-align: center;font-family: 微软雅黑;color: #646464">邮 &nbsp;&nbsp;箱：</label>
                            <div class="col-sm-8">
                                <input type="text" name="user_email" class="form-control" id="inputPassword" placeholder="邮箱">
                            </div>
                        </div>
                        <div class="col-sm-6 col-sm-offset-7">
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
        $("#kuang").hide();
        $("#sub").click(function() {
            $.ajax({
                'type': 'post',
                'url': "/_user_register",
                'data': {
                    "user_username": $("input[name='user_username']").val(),
                    "user_nickname": $("input[name='user_nickname']").val(),
                    "user_password": $("input[name='user_password']").val(),
                    "user_sex": $("input[name='user_sex']").val(),
                    "user_intro": $("textarea[name='user_intro']").val(),
                    "user_email": $("input[name='user_email']").val()
                },
                'success': function(msg) {
                    if (msg.status == true)
                    {
                        $("#kuang").show(500);
                        $("#sss").html(msg.message);
                        var $txt = $('#myspan');
                        (function() {

                            var v = parseInt($txt.html());
                            if (v > 0) {
                                $txt.html(--v);
                                setTimeout(arguments.callee, 1000); // 每秒减小一次
                            }
                        })();
                        setTimeout('window.location = "/admin_login";', 5000);
                    }
                    else
                    {
                        $("#kuang").show(500);
                        $("#sss").html(msg.message);
                    }
                }
            });
        });
    });
</script>
@stop
