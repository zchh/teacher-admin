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


        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" >
                 分类选项 <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li  ng-repeat="class in article.classData"><a href="#" ng-click="article.changeLimit('class',class.class_id)">@{{class.class_name}}</a></li>

            </ul>
        </div>
        <hr>
        <table class="table table-hover table-condensed table-bordered">
            <tr>
                <th><span class="glyphicon glyphicon-file" aria-hidden="true"></span> 文章标题</th>
                <th><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> 文章分类</th>
                <th><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> 点击量</th>
                <th><span class="glyphicon glyphicon-time" aria-hidden="true"></span> 创建时间</th>
                <th><span class=" glyphicon glyphicon-link" aria-hidden="true"></span> 操作</th>
            </tr>
            <tr ng-repeat="article in article.articleData" class="article_item">
                <td ng-bind="article.article_title"></td>
                <td ng-bind="article.class_name"></td>
                <td ng-bind="article.article_click"></td>
                <td ng-bind="article.article_create_date"></td>
                <td><button class="btn btn-danger btn-xs">删除</button></td>
            </tr>
        </table>
        <nav>
          当前第 @{{ article.nowPage }} 页 | 总计 @{{ article.totalPage }} 页
            <ul class="pager">
                <li><a href="#" ng-show="article.nowPage>1"
                       ng-click="article.previousPage()">前一页</a></li>

                <li><a href="#" ng-show="article.nowPage<article.totalPage"
                       ng-click="article.nextPage()">下一页</a></li>
            </ul>
        </nav>

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