
@extends("User.Article.base")
@section("main")

@foreach($articleData  as $data)
@if($data -> article_id == $article_id)


<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-body">
            <h1><p class="text-left">{{$data -> article_title}}</p></h1>
            <p class="text-left"><img src="/image/collect.png" style="width:4%;height:4%"></p>/**收藏提示**/

   <h2><small><p class="text-left">{{$data -> article_update_date}}  by {{$data -> user_username }}</p></small></h2>
   <hr>
   <h2><small><p class="text-left"><?php echo $data -> article_detail;?></p></small></h2>
   <hr>
        <nav class="pull-left">
          <ul class="pager">
              @if($previousArticle!=-1)
                   <li><a href="/user_readSingleArticle/{{$previousArticle}}">《 前一页 </a></li>
              @endif
              @if($nextArticle!=-1 )
                <li><a href="/user_readSingleArticle/{{$nextArticle}}">下一页 》</a></li>
              @endif           
          </ul>
        </nav>
      
        <?php echo $replyData; ?>


  </div>
  </div> 
 </div>
 <div class="col-md-2"></div>
 @endif
 @endforeach  
 

 

@stop




