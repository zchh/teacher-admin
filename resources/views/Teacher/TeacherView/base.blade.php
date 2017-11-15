<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>为蓝出行企业账号管理平台</title>
@section("head")
{{--<link href="{{ asset('teacher/imgs/favicon.ico') }}">--}}
<link href="{{ asset('teacher/img/neusoft.jpg') }}">
<link href="{{ asset('teacher/css/bootstrap.min14ed.css?v=3.3.6') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('teacher/css/font-awesome.min93e3.css?v=4.4.0') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('teacher/css/animate.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('teacher/css/style.min862f.css?v=4.1.0') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('teacher/css/add-style.css') }}" rel="stylesheet" type="text/css">
<script src="{{ asset('teacher/js/jquery.min.js?v=2.1.4') }}"></script>
<script src="{{ asset('teacher/js/bootstrap.min.js?v=3.3.6') }}"></script>
<script src="{{ asset('teacher/js/addjs.js') }}"></script>
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

<body class="gray-bg top-navigation">
<div id="wrapper">
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom white-bg">
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand" style="padding:0;background:#fff;"><img style="width:100%; max-width: 40px;max-height: 40px;" src="{{ asset('teacher/img/neu.jpg') }}"></a>
                </div>
                <div class="navbar-collapse collapse" id="navbar">
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="">
                                <i class="fa fa-sign-out"></i> 退出
                            </a>
                        </li>
                    </ul>
                    <div class="container">
                        <ul class="nav navbar-nav" id="color-change">
                            <li class="li1">
                                <a aria-expanded="false" role="button" href=""> 首页</a>
                            </li>
                            <li class="li2">
                                <a aria-expanded="false" role="button" href="/t_s_grade_config">得/扣分类型配置</a>
                            </li>
                            <li class="li2">
                                <a aria-expanded="false" role="button" href="/t_admin_student">学生管理</a>
                            </li>
                            <li class="li3">
                                <a aria-expanded="false" role="button" href=""> 账户管理</a>
                            </li>
                            <li class="li4">
                                <a aria-expanded="false" role="button" href=""> 系统设置</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
@section("content")

@show
    </div>
</div>
</body>