
@extends("Teacher.Base.base")
@section("body")

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div class="login-logo"><img src="{{URL::asset('/teacher/img/neu.jpg')}}" style="height: 80px;width: 80px"></div>
            <form class="m-t" role="form" action="/t_check_teacher_login" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="user_name" placeholder="用户名" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="密码" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
            </form>
        </div>
    </div>


@stop
@section("footer")
@stop