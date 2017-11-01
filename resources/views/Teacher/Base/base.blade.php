@section("head")
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>教师便捷管理学生系统</title>
<link href="{{ asset('teacher/img/neusoft.jpg') }}">

{{--<link rel="stylesheet" href="/teacher/js            /source/bootstrap/css/bootstrap.min.css">--}}
<link href="{{ asset('teacher/css/bootstrap.min14ed.css?v=3.3.6') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('teacher/css/font-awesome.min93e3.css?v=4.4.0') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('teacher/css/animate.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('teacher/css/style.min862f.css?v=4.1.0') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('teacher/css/add-style.css') }}" rel="stylesheet" type="text/css">
</head>

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



@show
<body class="gray-bg top-navigation">
@section("body")

@show
</body>
<script src="{{ asset('teacher/js/jquery.min.js?v=2.1.4') }}"></script>
<script src="{{ asset('teacher/js/bootstrap.min.js?v=3.3.6') }}"></script>
<script src="{{ asset('teacher/js/addjs.js') }}"></script>