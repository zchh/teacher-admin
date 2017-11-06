<html lang="en">
@section("head")
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>酷余后台管理系统</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset("teacher/bower_components/bootstrap/dist/css/bootstrap.min.css") }}" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{ asset("teacher/bower_components/metisMenu/dist/metisMenu.min.css") }}" rel="stylesheet">


        <!-- Timeline CSS -->
        <link href="{{ asset("teacher/dist/css/timeline.css") }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{ asset("teacher/dist/css/sb-admin-2.css") }}" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="{{ asset("teacher/bower_components/morrisjs/morris.css") }}" rel="stylesheet">

        <link href="{{ asset("teacher/bower_components/bootstrap/dist/css/bootstrap-datepicker.min.css") }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{ asset("teacher/bower_components/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet" type="text/css">


        <link rel="stylesheet" href="{{ asset('teacher/laydate/need/laydate.css') }}">

        <!-- 单击图片显示大图 -->
        <link rel="stylesheet" href="{{ asset('teacher/css/image-style.css') }}" media="screen" type="text/css" />


        <!-- 加载编辑器的容器 -->
        <script id="container" name="content" type="text/plain">
        这里写你的初始化内容
    </script>
        <!-- 配置文件 -->
        <script type="text/javascript" src="{{ asset('teacher/ueditor/ueditor.config.js') }}"></script>
        <script type="text/javascript" src="{{ asset('teacher/ueditor/ueditor.all.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('teacher/laydate/laydate.js') }}"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery -->
        <script src="{{ asset("teacher/bower_components/jquery/dist/jquery.min.js") }}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset("teacher/bower_components/bootstrap/dist/js/bootstrap.min.js") }}"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{ asset("teacher/bower_components/metisMenu/dist/metisMenu.min.js") }}"></script>

        <!-- Morris Charts JavaScript -->
        <script src="{{ asset("teacher/bower_components/raphael/raphael-min.js") }}"></script>


        <!-- Custom Theme JavaScript -->
        <script src="{{ asset("teacher/dist/js/sb-admin-2.js") }}"></script>

        <!-- 时间选择器 -->
        <script src="{{ asset("teacher/bower_components/bootstrap/dist/js/bootstrap-datepicker.min.js") }}"></script>
        <script src="{{ asset("teacher/bower_components/bootstrap/dist/js/bootstrap-datepicker.zh-CN.min.js") }}"></script>
        <script src="{{ asset('teacher/js/image.js') }}"></script>

        <script language="JavaScript">
            function confirm_del() {
                var msg="您真的确定要删除吗？";
                if (confirm(msg)==true){
                    return true;
                }else{
                    return false;
                }
            }
            function confirm_out() {
                var msg="您真的确定要移除黑名单吗？";
                if (confirm(msg)==true){
                    return true;
                }else{
                    return false;
                }
            }
        </script>
    </head>
@show
@section("message")
    @if(session('__Ajax_RedirectFunc_status') == true)
        <div>
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3>成功</h3>
                <p><?php echo session('__Ajax_RedirectFunc_message');?></p>
                <p><?php echo session('__Ajax_RedirectFunc_plugin');?></p>
            </div>
        </div>
    @endif
    @if(session('__Ajax_RedirectFunc_status') === false)
        <div >
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3>失败</h3>
                <p><?php echo session('__Ajax_RedirectFunc_message');?></p>
                <p><?php echo session('__Ajax_RedirectFunc_plugin');?></p>
            </div>
        </div>
    @endif
@show
<body>
<div id="wrapper">
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
@section('header')
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">酷余后台管理系统</a>
    </div>

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href=""><i class="fa fa-user fa-fw"></i> 管理员信息</a>
                </li>
                <li><a  data-toggle="modal" data-target="#myModal"><i class="fa fa-gear fa-fw"></i> 修改密码</a>
                </li>
                <li class="divider"></li>
                <li><a href=""><i class="fa fa-sign-out fa-fw"></i> 退出登录</a>
                </li>
            </ul>
        </li>
    </ul>
@show
@section('sidebar')
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <!-- 超级管理员权限-->
                <li>
                    <a href="#" class="side-nav-a"><i class="fa fa-user fa-fw fa-m-r"></i>教师管理</a>
                </li>

                <li>
                    <a href="#" class="side-nav-a"><i class="fa fa-columns fa-fw fa-m-r"></i>学生管理</a>
                </li>

                <li>
                    <a href="#" class="side-nav-a"><i class="fa fa-columns fa-fw fa-m-r"></i>班级管理</a>
                </li>

                <li>
                    <a href="#" class="side-nav-a"><i class="fa fa-list-alt fa-fw fa-m-r"></i>专业管理</a>
                </li>
            </ul>
        </div>
    </div>
@show
</nav>
@section("content")

@show
</div>
@section("changePassword")
    <!-- 修改密码表单 -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-remove"></i></span></button>
                        <h4 class="modal-title" id="myPwdSetting">修改密码</h4>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-horizontal " id="settingPwdForm" name="settingPwdForm">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">旧密码</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="输入当前密码" required >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">新密码</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="newPassword" name="password" placeholder="输入6到20个字符" required >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">确认密码</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="againPassword" n placeholder="输入6到20个字符"  required >
                                </div>
                            </div>
                            <div class="modal-footer noborder">
                                <button onclick="changePassword(this)" type="button"  class="btn btn-primary " >保存</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@show
</body>
<script src="{{ asset("teacher/bower_components/morrisjs/morris.min.js") }}"></script>
<script src="{{ asset("teacher/js/morris-data.js") }}"></script>
<script src="{{ asset("teacher/bower_components/flot/excanvas.min.js") }}"></script>
<script src="{{ asset("teacher/bower_components/flot/jquery.flot.js") }}"></script>
<script src="{{ asset("teacher/bower_components/flot/jquery.flot.pie.js") }}"></script>
<script src="{{ asset("teacher/bower_components/flot/jquery.flot.resize.js") }}"></script>
<script src="{{ asset("teacher/bower_components/flot/jquery.flot.time.js") }}"></script>
<script src="{{ asset("teacher/bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js") }}"></script>
<script src="{{ asset("teacher/js/flot-data.js") }}"></script>
<script>
    var carrousel = $( ".carrousel" );
    $( ".big-img-div" ).click( function(e){
        var src = $(this).find(".pic").attr( "data-src-wide" );
        carrousel.find("img").attr( "src", src );
        carrousel.fadeIn( 200 );
    });
    carrousel.find( ".wrapper" ).click( function(e){
        carrousel.find( "img" ).attr( "src", '' );
        carrousel.fadeOut( 200 );
    } );
    function changePassword()
    {

        if ($("#oldPassword").val() == '')
        {
            alert('旧密码不能为空')
            return false;
        }
        if ($("#newPassword").val() == '' || $("#againPassword").val() == ''){
            alert('新密码不能为空')
            return false;
        }
        if ($("#newPassword").val() != $("#againPassword").val() ) {
            alert('两次密码输入不一致')
            return false;
        }
        $.ajax({
            url: "",
            type: "post",
            data: $('#settingPwdForm').serializeArray(),
            cache: false,
            async: false,
            dataType: "json",
            success: function (data) {
                var statusCode = data['statusCode'];
                if (statusCode == 200) {
                    alert('密码修改成功！')
                    location.href = "";
                }
                if (statusCode == 300) {
                    alert('原密码错误！')
                }
                if (statusCode == 302) {
                    alert('登录过期，请重新登录！')
                    location.href = "";
                }
            },
            error: function () {
                alert('刷新请重试！');
            }
        });
    }</script>
</html>