@extends("Teacher.Base.base")
@section("body")

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">管理员管理系统</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="/t_check_admin_login">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="请输入管理员账号" name="admin_name" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="请输入管理员密码" name="password" type="password" value="">
                                </div>
                                <div class="form-group">

                                </div>
                                <!-- Change this to a button or input when using this as a form -->

                                <button class="btn btn-lg btn-success btn-block">登录</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section("footer")
@stop