@extends("User.Article.base")


@section("main")
    <div ng-controller="ArticleController">

        <div class="col-sm-10 " >
            <!-- 查看文章的界面-->
           <div ng-view id="articleView" >

           </div>
        </div>


    </div>
@stop



@section("head")
    @parent
    <base href="/">
    <link rel="stylesheet" href="/webapp/style/User/article.css">
@append


@section("ngJs")
    @include("ng_lib")
    <script src="/webapp/scripts/controllers/ArticleController.js"></script>
@append

@section("message")
    @parent
    <div  header-msg  p-msg="@{{headerMsg.msg}}" p-status="@{{headerMsg.status}}" p-auto-hide="true"></div>
@append