
<!DOCTYPE html >
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

        <meta name="csrf-token" content="<?php echo csrf_token() ?>" >
        <link rel="stylesheet" href="/webapp/style/base.css">
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </head>
@show

<body ng-app="baseCms">
@section("message")
   <div  header-msg  p-msg="@{{showHeaderMsg}}" p-status="@{{showHeaderMsg}}" p-auto-hide="true"></div>
@show


@section("body")



@show




</body>
    @section("js")
        <script src="/webapp/bower_components/angular/angular.min.js"></script>
        <script src="/webapp/bower_components/angular-messages/angular-messages.min.js"></script>
        <script src="/webapp/bower_components/angular-route/angular-route.min.js"></script>

        <script src="/webapp/scripts/app.js"></script>
        <script src="/webapp/scripts/directive/headerMsg.js"></script>

    @show
</html>
