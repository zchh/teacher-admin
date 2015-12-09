@extends("User.ng_base")


@section("main")
<div ng-controller="ArticleController">
    <div class="col-sm-12" id="header_gap">
        <h2 ng-bind="nowStatus.title"></h2>
    </div>

    <div class="col-sm-2">
        <ul class="nav nav-pills nav-stacked" >
            <li ng-class="{active:nowStatus.url=='/sArticle'}"><a >查看所有文章</a></li>
            <li ng-class="{active:nowStatus.url=='/sSubject'}"><a >查看</a></li>
        </ul>
    </div>
    <div class="col-sm-10">
        <button class="btn-success btn" ng-click="" >
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            添加文章
        </button>
        <button class="btn-success btn" ng-click="" >
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>

        </button>

        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" ng-bind="article.limit.sort">
                 所有文章<span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#" ng-click="article.changeClass('')">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
            </ul>
        </div>
        <hr>
        <div ng-bind="article|json"></div>

    </div>

</div>
@stop

@section("js")
    @parent
    <script src="/webapp/scripts/controllers/ArticleController.js"></script>
    <script src="/webapp/scripts/services/ArticleService.js"></script>
@append

@section("head")
    @parent
    <link rel="stylesheet" href="/webapp/style/User/article.css">
@append