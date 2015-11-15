@extends("User.Article.base")
@section("main")




<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-body">
          
             
            <h2>当前收藏夹：{{$nowCollect[0]->class_name}} | <button class="btn  btn-primary "  data-toggle="modal" data-target="#aCollect" type="button">添加收藏夹</button></h2>              
            <div class="modal fade" id="aCollect" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">添加收藏夹</h4>
                        </div>
                        <div class="modal-body">
                            <form action="/user_aCollect" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <h4>收藏夹名称</h4>
                                <input type="text " id="inputText" class="form-control" name="class_name" placeholder="Collectname" required autofocus>                            
                                </div>
                                <div class="modal-footer">
                                    <button class="btn  btn-primary" type="submit">添加</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div></h2>
            <hr>
        @if($nowCollect != NULL)
            <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>文章</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($moreCollect as $data)
                    @if($data->collect_folder==0)
                    <tr>
                        <td><a href="/user_readSingleArticle/{{$data->article_id}}"> <img src="/image/article.png" style="width:5%;height:5%"> {{$data->article_title}}</a></td>
                        <td>删除</td>
                    </tr>
                    @else
                    <tr>
                        <td><a href="/user_moreCollect/{{$data->collect_id}}"><img src="/image/collect.png" style="width:5%;height:5%"> {{$data->class_name}}</a></td>
                        <td>删除</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>

@stop
