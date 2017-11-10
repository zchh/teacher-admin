@extends("Teacher.AdminView.base")
@section("content")
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">管理员详情</h4>
        </div>
        <!-- /.col-lg-12 -->
        <div class="container">
            <form class="form-horizontal" role="form" method="post" action="/t_edit_admin_info" onsubmit="return check(this)">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input name="id" type="hidden" value="{{$adminInfo->id}}">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">管理员编号</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="number" value="{{$adminInfo->number}}" placeholder="输入当前密码" required >
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">管理员账号</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="admin_name" value="{{$adminInfo->admin_name}}" placeholder="输入当前密码" required >
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">姓名</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{$adminInfo->name}}" placeholder="输入当前密码" required >
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">身份证号</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="id_number" value="{{$adminInfo->id_number}}" placeholder="输入当前密码" required >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">提交</button>
                        <button type="button" onclick="history.back()" class="btn btn-default">取消</button>
                    </div>
                </div>

            </form>
        </div>
        <!-- /.row -->
    </div>


@stop
@section("footer")
@stop