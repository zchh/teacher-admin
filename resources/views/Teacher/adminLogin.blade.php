@extends("Index.base")

@section("body")
    
    <div class="container-fluid">
		
		
        <div class="col-sm-12" style="height:100px">
                
        </div>
	<div class="col-sm-4 col-sm-offset-4">
                <div class="panel panel-default">
                     <div class="panel-body">
                            <h2 style="text-align:center">
                                    管理员登陆
                            </h2>
                             <hr/>
                             <form action="/admin_check_login" method="post">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-group">
                                                <label>管理员</label>
                                                <input type="text" class="form-control" name="adminName" placeholder="管理员用户名">
                                        </div>
                                        <div class="form-group">
                                                <label>密码</label>
                                                <input type="password" class="form-control" name="password" placeholder="管理员密码">
                                        </div>

                                        <button type="submit" class="btn btn-default">提交</button>
                                </form>
                      </div>
                </div>
        </div>
@stop
@section("footer")
@stop