@extends("Index.base")

@section("main")


 <div class="col-sm-9" >
     <div class="panel panel-default">
         <div class="panel-body" style="background-color: gray">
           @foreach($article as $single)
           @foreach($article_id as $single_id)
           @if($single_id -> relation_article == $single -> article_id)
             <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3 class="panel-title">{{$single->article_title}}</h3>
                        </div>
                        <div class="panel-body">
                         {{$single->article_intro}}
                         <hr/>
                         <a href="/index_articleDetail/{{$single -> article_id}}" class="btn btn-default">查看详情</a>
                        </div>
                    </div>
             </div>
           @endif
           @endforeach
           @endforeach

@stop

