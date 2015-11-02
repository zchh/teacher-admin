@extends("Index.base")
@section("main")
<div class="row">
    <div class="col-md-9">
        <div class="col-md-12" style="height:200px">




            <div style="position:absolute;z-index:-1;width:100%;height:100%">
                <img src="/Public/2h.jpg"  style="width:100%;height:100%"></div>
            
            <div>这里添加图片和用户名
                昵称：{{$data -> user_nickname}}</div>
        </div>
        <div class="col-md-12">
            <nav>
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="#">他的主页</a></li>
                    <li role="presentation"><a href="#">他的照片</a></li>
                </ul>
            </nav>



        </div>
        <div class="col-md-12">
      
            <div class="panel panel-default">
                <div class="panel-body" style="background-color: gray">
                    @foreach($article as $single)

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{$single->article_title}}</h3>
                        </div>
                        <div class="panel-body">
                            {{$single->article_intro}}
                            <hr/>
                            <a href="/index_articleDetail/{{$single->article_id}}" class="btn btn-default">查看详情</a>
                        </div>
                    </div>

                    @endforeach








                </div>

            </div>

        </div>
    </div>
    <div class="col-md-3">右边框</div>
</div>
@stop





