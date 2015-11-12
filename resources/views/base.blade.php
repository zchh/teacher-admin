<!DOCTYPE html>
@section("head")

<head>
<meta charset="UTF-8">
<title>@yield("title",config("my_config.title_name"))</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="renderer" content="webkit">
<!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="/source/bootstrap/css/bootstrap.min.css">

<!-- 可选的Bootstrap主题文件（一般不用引入） -->
<link rel="stylesheet" href="/source/bootstrap/css/bootstrap-theme.min.css">
<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="/source/js/jquery-1.9.1.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="/source/bootstrap/js/bootstrap.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />


<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
</head>
@show

<body>
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

    
@section("body")
   
   

@show




</body>

</html>