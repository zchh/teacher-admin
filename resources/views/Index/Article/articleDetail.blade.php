@extends("Index.base")
@section("main")

@foreach($articleData  as $data)
@if($data -> article_id == $article_id)
 
 <div class="col-md-8">
  <div class="panel panel-default">
  <div class="panel-body">

   <h1><p class="text-left">{{$data -> article_title}}</p></h1>
   <h2><small><p class="text-left">{{$data -> article_update_date}}  by <a href="/index_userIndex/{{$data -> user_id}}">{{$data -> user_username }}</a> </p></small></h2>
   <hr>
   <h2><small><p class="text-left"><?php echo $data -> article_detail;?></p></small></h2>
     
        <nav class="pull-left">
          <ul class="pager">
              @if($previousArticle!=-1)
                   <li><a href="/index_articleDetail/{{$previousArticle}}">《 前一页 </a></li>
              @endif
              @if($nextArticle!=-1 )
                <li><a href="/index_articleDetail/{{$nextArticle}}">下一页 》</a></li>
              @endif           
          </ul>
        </nav>
        <hr/>
        <?php echo $replyData; ?>


  </div>
  </div> 
 </div>
 <div class="col-md-2"></div>
 @endif
 @endforeach  


@stop





