@extends("Index.base")
@section("main")

<div class="col-sm-8 col-sm-offset-1">
    <div class="panel panel-default">
        <div class="panel-body">

            <h1><p class="text-left">{{$articleData -> article_title}}</p></h1>
            <h2><small><p class="text-left">{{$articleData -> article_update_date}}  by <a href="/index_userIndex/{{$articleData -> user_id}}">{{$articleData -> user_username }}</a> </p></small></h2>
            
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
        <hr>
            <img src="/getImage/{{$articleData->article_image}}" class="img-responsive img-rounded">
            <div id="article_detail_div">
                <?php echo $articleData->article_detail; ?>
            </div>    
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
<script>
 
 $("#article_detail_div  img").addClass("img-responsive");


</script>


   

@stop





