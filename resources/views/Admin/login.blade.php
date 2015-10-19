@extends("base")

@section("body")
    <img src="/image/2h.jpg" style="height:100%;width:100%;z-index:0;position:fixed">
    <div class="container-fluid">
		
		
        <div class="col-sm-12" style="height:100px">
                
        </div>
	<div class="col-sm-4 col-sm-offset-4">
                <div class="panel panel-default">
                     <div class="panel-body">
                            <h2 style="text-align:center">
                                    登陆
                            </h2>
                             <hr/>
                             <form action="/_admin_login" method="post">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-group">
                                                <label>留言人</label>
                                                <input type="text" class="form-control" name="admin_username" placeholder="管理员用户名">
                                        </div>
                                        <div class="form-group">
                                                <label>详情</label>
                                                <input type="password" class="form-control" name="admin_password" placeholder="管理员密码">
                                        </div>

                                        <button type="submit" class="btn btn-default">提交</button>
                                </form>
                      </div>
                </div>
        </div>
@stop