@extends("ng_base")
@section("body")

    @section("left_nav")
        <ul class="nav nav-pills nav-stacked">
            <li ng-class="{active:nowUrl=='/..'}"><a >查看所有文章</a></li>
        </ul>

        @show
    @section("main")

        @show
@append