@extends("User.base")
@section("body")
  <div class="row">
@
  <div class="col-md-12"><h1 align="center">{{$data -> article_title}}</h1></div>
  <div class="col-md-12"><h2 align="center">{{$data -> article_update_date}}</h2></div>
  <div class="col-md-12"><h2><small>{{$data -> article_detail}}</small></h2></div>
  <div class="col-md-12">
      <a href="#" class="btn btn-primary btn-lg disabled" role="button">前一页</a>
      <a href="#" class="btn btn-primary btn-lg disabled" role="button">后一页</a></div>
 @
</div>

        
@stop