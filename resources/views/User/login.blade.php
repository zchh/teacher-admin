@extends("Index.base")

@section("body")
    
    <div class="container-fluid">
		
		
        <div class="col-sm-12" style="height:100px">
                
        </div>
	<div class="col-sm-4 col-sm-offset-4">
                <div class="panel panel-default">
                     <div class="panel-body">
                            <h2 style="text-align:center">
                                    用户登陆
                            </h2>
                             <hr/>
                             <form action="/_user_login" method="post">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-group">
                                                <label>登录名</label>
                                                <input type="text" class="form-control" name="user_username" placeholder="用户名 ">
                                        </div>
                                        <div class="form-group">
                                                <label>密码</label>
                                                <input type="password" class="form-control" name="user_password" placeholder="用户密码 ">
                                        </div>

                                        <button type="submit" class="btn btn-primary">登陆</button>
                                        <a href="/user_register" class="btn btn-success">注册</a>
                                </form>
                      </div>
                </div>
        </div>
@stop
@section("footer")
@stop