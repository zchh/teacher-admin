@extends("Teacher.TeacherView.base")
@section("content")
            <div class="wrapper wrapper-content">
                <div class="container">

                    <div class="row">

                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>修改登录密码</h5>
                                </div>
                                <div class="ibox-content">
                                    <form method="post" action="/t_teacher_reset_password" class="form-horizontal" onsubmit="checkReset(this)">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">头像</label>
                                            <div class="col-sm-10">
                                                <img src="/get_pic/{{$teacher->pic_id}}" style="width:100%; max-width: 80px;max-height: 80px;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">姓名</label>
                                            <div class="col-sm-10">
                                                 {{ $teacher->name }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">原密码</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="oldPassword" placeholder="请输入原登录密码" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">新密码</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="newPassword1" placeholder="请输入新登录密码" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">新密码</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="newPassword2" placeholder="请重复输入新登录密码" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <button class="btn btn-success" type="submit">确定修改</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <script>
                function checkReset(form) {
                    if(form.oldPassword.value == ''){
                        alert("原密码不能为空！");
                        form.oldPassword.focus();
                        return false;
                    }
                    if(form.newPassword1.value == ''){
                        alert("新密码不能为空！");
                        form.newPassword1.focus();
                        return false;
                    }
                    if(form.newPassword2.value == ''){
                        alert("新密码不能为空！");
                        form.newPassword2.focus();
                        return false;
                    }
                }
            </script>

@stop
@section("footer")
@stop