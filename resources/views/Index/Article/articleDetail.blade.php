@extends("Index.base")
@section("main")

<div class="col-sm-8 col-sm-offset-1">
    <div class="panel panel-default">
        <div class="panel-body">

            <h1><p class="text-left">{{$articleData -> article_title}}</p></h1>
            <h2><small><p class="text-left">{{$articleData -> article_update_date}}  by 
                        <a href="/index_userIndex/{{$articleData -> user_id}}">{{$articleData -> user_nickname }}</a>|
                                   
                             | <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> {{$articleData->article_reply}}
                       </p></small></h2>
        @if($collectStatus != true)
        <button class="btn  btn-primary "  data-toggle="modal" data-target="#add" type="button">点击收藏</button></h2>              
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">收藏文章</h4>
                        </div>
                        <div class="modal-body">
                            <form action="/user_addArticleToCollect" method="post">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden" name="collect_article_id" value="{{$articleData -> article_id}}">
                                <h4>添加到</h4>
                                <select class="form-control" name="collect_class">
                                    @foreach($classData as $value)
                                    <option type="select" value="{{$value->class_id}}" selected="selected">{{$value->class_name}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-primary" type="submit">提交</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <hr>
        <div class="col-sm-8 col-sm-offset-2"><img src="/getImage/{{$articleData->article_image}}" class="img-responsive img-rounded"></div>
        <div class="col-sm-2"></div>
        
        <div id="article_detail_div" class="col-sm-12">
                <blockquote>
                    <p>简介：<?php echo $articleData->article_intro; ?></p>
                  </blockquote>
                <?php echo $articleData->article_detail; ?>
        </div>

        <hr>
        <?php echo $replyData; ?>


        </div>
    </div> 
</div>
<div class="col-sm-2">
    <?php echo $userInfoGui ?>

    <div class="panel panel-default">
        <div class="panel-body">
           <?php echo $sidebarRecommendGui;?>
        </div>
    </div>
</div>



<link rel="stylesheet" href="/source/codehl/styles/default.css">
<script src="/source/codehl/highlight.pack.js"></script>


<script>


$(document).ready(function(){
    $('pre').each(function(i, block) {
        hljs.highlightBlock(block);
    });
    $("#article_detail_div  img").addClass("img-responsive");
});

</script>


   

@stop





