@extends("User.base")
@section("body")
  <div class="row">
@foreach($articleData  as $data)
@if($data -> article_id == $article_id)
  <div class="col-md-12"><h1 align="center">{{$data -> article_title}}</h1></div>
  <div class="col-md-12"><h2 align="center">{{$data -> article_update_date}}  by {{$data -> user_username }}</h2></div>
  <div class="col-md-12"><h2><small><?php echo $data -> article_detail;?></small></h2></div>
  <div class="col-md-12">
      
        <nav>
          <ul class="pager">
              @if($previousArticle!=-1)
                   <li><a href="/user_readSingleArticle/{{$previousArticle}}">《 前一页 </a></li>
              @endif
              @if($nextArticle!=-1 )
                <li><a href="/user_readSingleArticle/{{$nextArticle}}">下一页 》</a></li>
               @endif
            
          </ul>
        </nav>
     
      
  </div>
 @endif
 @endforeach
</div>

        
@stop
