@extends("Index.base")

@section("main")

      <div class="col-sm-10 col-sm-offset-1">
        <div class="col-sm-9">
             @foreach($articleData as $data)
             <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-sm-8">
                                <h4>{{$data->article_title}} </h4><small> | {{$data->article_create_date}}.</small><br>
                                {{$data->article_intro}}
                            </div>
                            <div class="col-sm-4">
                                <img src="/Public/2h.jpg" class="img-responsive img-rounded">
                                    
                            </div>
                            <div class="col-sm-12">
                            <a href="/index_articleDetail/{{$data->article_id}}" class="btn btn-default btn-xs pull-right">查看详情</a>
                            </div>
                         
                        </div>
                    </div>
             </div>
             
           @endforeach
          
        </div>
        <div class="col-sm-3">
        </div>
       
    
    </div>

@stop