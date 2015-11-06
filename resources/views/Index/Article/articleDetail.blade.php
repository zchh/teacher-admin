@extends("Index.base")
@section("main")

 <div class="col-sm-8 col-sm-offset-1">
  <div class="panel panel-default">
  <div class="panel-body">

   <h1><p class="text-left">{{$articleData -> article_title}}</p></h1>
   <h2><small><p class="text-left">{{$articleData -> article_update_date}}  by <a href="/index_userIndex/{{$articleData -> user_id}}">{{$articleData -> user_username }}</a> </p></small></h2>
   <hr>
  <?php echo $articleData -> article_detail;?>
     
        <hr/>
        <?php echo $replyData; ?>


  </div>
  </div> 
 </div>
    <div class="col-sm-2">
        <div class="panel panel-default">
            <div class="panel-body">
                    <img src="/Public/2h.jpg" class="text-center img-circle img-responsive" style="width:80%;height:100%;left: 10%;position:relative">
                    <hr/>
                    <h4 style='margin: auto'>{{$userData->user_username}}</h4>
                    <hr>
                    <small>{{$userData->user_intro}}</small>
                    <hr>
                    <a  class="btn btn-default btn-sm" href="/index_userIndex/{{$userData->user_id}}" aria-label="Left Align">
                      <span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span>  个人主页
                    </a>
                     <a  class="btn btn-default btn-sm" href="#" aria-label="Left Align">
                      <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>  关注
                    </a>
             </div>
       </div>
        
         <div class="panel panel-default">
            <div class="panel-body">
                    特殊推荐表
             </div>
       </div>
    </div>




@stop





