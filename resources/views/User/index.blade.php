@extends("User.base")

@section("main")
<div class="col-sm-8 col-sm-offset-2">



    <div class="panel panel-default">
        <div class="panel-body">

            <div class="col-sm-12" class="col-sm-12" style="height:10px"></div>
            <div class="col-sm-12">

                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs " role="tablist">
                        <li role="presentation" class="active"><a href="#article" aria-controls="article" role="tab" data-toggle="tab">
                                <h3><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 所关注好友文章</h3>
                            </a></li>
                        <li role="presentation"><a href="#subject" aria-controls="subject" role="tab" data-toggle="tab">
                                <h3><span class="glyphicon glyphicon-book" aria-hidden="true"></span> 最近专题</h3></a></li>
                        <li role="presentation"><a href="#image" aria-controls="image" role="tab" data-toggle="tab">
                                <h3><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> 好友动态</h3></a></li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="article" class="tab-pane active " id="article">
                            @foreach($article_attentioned_data as $data)

                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-sm-8">
                                        <h4>{{$data[0]->article_title}} </h4><small> | {{$data[0]->article_create_date}}.</small><br>
                                        {{$data[0]->article_intro}}

                                    </div>
                                    <div class="col-sm-4">
                                        <img src="/Public/2h.jpg" class="img-responsive img-rounded">

                                    </div>
                                    <div class="col-sm-12">
                                        <a href="/index_articleDetail/" class="btn btn-default  ">查看详情</a>
                                    </div>


                                </div>
                            </div>




                            @endforeach


                        </div>
                        <div role="subject" class="tab-pane fade " id="subject">
                            <!-- 循环2-->

                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-sm-8">
                                        <h4> </h4><small> | </small><br>

                                    </div>
                                    <div class="col-sm-4">
                                        <img src="/Public/2h.jpg" class="img-responsive img-rounded">

                                    </div>
                                    <div class="col-sm-12">
                                        <a href="/index_moreSubject/" class="btn btn-default  ">查看详情</a>
                                    </div>

                                </div>
                            </div>



                            <!-- 循环2结束-->
                        </div>
                        <div role="image" class="tab-pane  fade" id="image">
                            sadaddasdasd
                        </div>

                    </div>



                </div>


            </div>

        </div>
    </div>
</div>
@stop
