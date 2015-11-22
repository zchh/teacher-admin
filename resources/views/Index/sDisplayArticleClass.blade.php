@extends("Index.base")

@section("main")
    <div class="col-sm-7 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-sm-12"><h2>{{$nowClassName}}</h2></div>
                 @foreach($articleData as $data)
                 <div class="col-sm-12">
                        <div class="panel panel-default">
                             <div class="panel-body">
                                 <div class="col-sm-9">
                                    <h3><a href="/index_articleDetail/{{$data->article_id}}">
                                    {{$data->article_title}}
                                     </a><br>
                                     <small>{{$data->article_create_date}} | 
                                       <span class="glyphicon glyphicon-align-left" aria-hidden="true"></span> {{$data->user_nickname}}             
                                        | <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> {{$data->article_reply}}
                                     </small></h3>
                                     <hr>
                                     {{$data->article_intro}}
                                     
                                 </div>
                                 <div class="col-sm-3">
                                     <img src="/getImage/{{$data->article_image}}" class="img-responsive img-rounded">
                                 </div>
                              </div>
                        </div>
                </div>
                  @endforeach
                
               
                <?php $articleData->render();?>
            </div>
        </div>

    </div>

    <div class="col-sm-3">
        <?php echo $articleClassBar;?>
    </div>
    <div class="col-sm-3">
        <?php echo $indexRecommendArticle;?>
    </div>
@stop