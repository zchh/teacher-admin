@extends("Index.base")
@section("main")

<div class="col-sm-8 col-sm-offset-1">
    <div class="panel panel-default">
        <div class="panel-body">

            <h1><p class="text-left">{{$articleData -> article_title}}</p></h1>
            <h2><small><p class="text-left">{{$articleData -> article_update_date}}  by <a href="/index_userIndex/{{$articleData -> user_id}}">{{$articleData -> user_username }}</a> </p></small></h2>
            <hr>
            <?php echo $articleData->article_detail; ?>

            <hr/>
            <?php echo $replyData; ?>


        </div>
    </div> 
</div>
<div class="col-sm-2">
    <?php echo $userInfoGui ?>

    <div class="panel panel-default">
        <div class="panel-body">
            特殊推荐表
        </div>
    </div>
</div>




@stop





