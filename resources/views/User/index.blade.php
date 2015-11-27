@extends("User.base")

@section("main")
<div class="col-sm-12 ">



    <div class="panel panel-default">
        <div class="panel-body">

            <div class="col-sm-12" class="col-sm-12" style="height:10px"></div>
            <div class="col-sm-12">

                <div class="col-sm-12"> <!-- Nav tabs -->
                    <ul class="nav nav-tabs " role="tablist">
                        <li role="presentation" class="active"><a href="#article" aria-controls="article" role="tab" data-toggle="tab">
                                <h3><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 好友动态</h3>
                            </a></li>
                        <li role="presentation"><a href="#subject" aria-controls="subject" role="tab" data-toggle="tab">
                                <h3><span class="glyphicon glyphicon-book" aria-hidden="true"></span> 推荐</h3></a></li>
                       

                    </ul>
                </div>
                   

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="article" class="tab-pane active " id="article">
                            @foreach($article_attentioned_data as $data)
                            <div class="col-sm-6">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="col-sm-8">
                                            <h4>{{$data->article_title}} </h4><small> | {{$data->article_create_date}}. | 作者： {{$data->user_nickname}}</small><br>
                                            {{$data->article_intro}}

                                        </div>
                                        <div class="col-sm-4">
                                            <img src="/getImage/{{$data->article_image}}" class="img-responsive img-rounded">

                                        </div>
                                        <div class="col-sm-12">
                                            <a href="/index_articleDetail/{{$data->article_id}}" class="btn btn-default  ">查看详情</a>
                                        </div>


                                    </div>
                                </div>
                            </div>




                            @endforeach
                            <?php  $article_attentioned_data->render();?>


                        </div>
                        <div role="subject" class="tab-pane fade " id="subject">
                            <div class="col-sm-12"><h2>功能未开放</h2></div>

                           
                        </div>
                        

                    </div>
            </div>

        </div>
    </div>
</div>
@stop
