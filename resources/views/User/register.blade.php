@extends("Index.base")
@section("main")
<div class="col-sm-6 col-sm-offset-3">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2 style="text-align:center">
                用户注册
            </h2>
            <hr/>
            <form class="form-horizontal" action="/_user_register" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">用户名：</label>
                    <div class="col-sm-10">
                        <input type="text" name="user_username" class="form-control" id="inputPassword" placeholder="用户名">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">用户昵称：</label>
                    <div class="col-sm-10">
                        <input type="text" name="user_nickname" class="form-control" id="inputPassword" placeholder="用户昵称">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">密码：</label>
                    <div class="col-sm-10">
                        <input type="password" name="user_password" class="form-control" id="inputPassword" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">性别：</label>
                    <div class="col-sm-10">
                        <input type="radio" name="user_sex" id="blankRadio1" value="男" aria-label="...">男
                        <input type="radio" name="user_sex" id="blankRadio1" value="女" aria-label="...">女
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">用户介绍：</label>
                    <div class="col-sm-10">
                        <textarea name="user_intro" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-sm-6 col-sm-offset-10">
                    <button type="submit" class="btn btn-default">提交</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
