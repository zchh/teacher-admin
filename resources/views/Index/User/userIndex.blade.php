@extends("Index.base")
@section("main")

<div class="col-sm-8 col-sm-offset-2">



    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-sm-12" style="background:url('/image/default.jpg');
                 background-size:100% 100%;height:300px;border: 1px solid gray;
                 border-radius:10px;	">
                <div style="margin: 15px auto; width:150px;height:150px">
                    <img src="/getImage/{{$userData->image_id}}" class="img-circle" style="margin:auto ;width:100%;height:100%">
                </div>
                <div style="width:150px;height:100px;margin:15px auto;" >
                    <h3 style="text-align: center;color:white">{{$userData->user_nickname}}</h3>
                    @if($userData->user_id != session("user.user_id")&& session("user.user_status")!=false)
                        @if($userData->relation_focus==$userData->user_id)
                        <button class="btn btn-default "  data-toggle="modal" data-target="#del_{{$userData->relation_id}}" aria-label="Left Align" style="margin: auto;display: block"> 取消关注</button>
                        <!-- Modal -->
                        <div class="modal fade" id="del_{{$userData->relation_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">将要取消关注！</h4>
                                    </div>
                                    <div class="modal-body">
                                        您确定要取消关注吗？
                                    </div>
                                    <div class="modal-footer">



                                        <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                        <a href="/user_dFocus/{{$userData->relation_id}}" class="btn btn-danger btn-sm">确定 </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <button class="btn btn-default "  data-toggle="modal" data-target="#aFocus" aria-label="Left Align" style="margin: auto;display: block"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span> 关注</button>          
                        <div class="modal fade" id="aFocus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">添加备注</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/user_aFocus" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="relation_focus" value="{{ $userData->user_id }}">

                                            <input type="text " id="inputText" class="form-control" name="relation_remark" placeholder="备注名称" value="{{$userData->user_nickname}}" required autofocus>                            
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn  btn-primary" type="submit">提交</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endif
                    @endif
                </div>

            </div>
            <div class="col-sm-12" class="col-sm-12" style="height:10px"></div>
            <div class="col-sm-12">

                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs " role="tablist">
                        <li role="presentation" class="active"><a href="#article" aria-controls="article" role="tab" data-toggle="tab">
                                <h3><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 文章</h3>
                            </a></li>
                        <li role="presentation"><a href="#subject" aria-controls="subject" role="tab" data-toggle="tab">
                                <h3><span class="glyphicon glyphicon-book" aria-hidden="true"></span> 专题</h3></a></li>
                        <li role="presentation"><a href="#image" aria-controls="image" role="tab" data-toggle="tab">
                                <h3><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> 图片</h3></a></li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="article" class="tab-pane active " id="article">
                            @foreach($articleData as $data)

                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="col-sm-8">
                                            <h4>{{$data->article_title}} </h4><small> | {{$data->article_create_date}}.</small><br>
                                            {{$data->article_intro}}
                                        </div>
                                        <div class="col-sm-4">
                                            <img src="/getImage/{{$data->article_image}}" class="img-responsive img-rounded">

                                        </div>
                                        <div class="col-sm-12">
                                            <a href="/index_articleDetail/{{$data->article_id}}" class="btn btn-default  ">查看详情</a>
                                        </div>


                                    </div>
                                </div>




                            @endforeach
                            <?php echo $articleData->render(); ?>

                        </div>
                        <div role="subject" class="tab-pane fade " id="subject">
                            <table class="table">
                                @foreach($subjectData as $data)
                                   <tr>
                                        <td>
                                            <a href="/index_moreSubject/{{$data->subject_id}}">
                                                {{$data->subject_name}}
                                            </a><small> {{$data -> subject_update_date}}</small>
                                        </td>

                                    </tr>            
                                 @endforeach
                            </table>
                            <?php echo $subjectData->render(); ?>
                        </div>
                        <div role="image" class="tab-pane  fade" id="image">
                            @foreach($imageData as $data)
                            
                                            <div class="col-sm-6 col-md-4" style="height:500px">
                    
                                                    <img src="/getImage/{{$data -> image_id}}" alt="..." class="img-responsive img-rounded" style="height:60%">
                                                    <div class="caption">
                                                        <h3>{{$data -> image_name}}</h3>
                                                        <p>{{$data -> image_intro}}</p>
                                                        
                                                    </div>

                                            </div>
                            @endforeach
                            <?php echo $imageData->render(); ?>
                        </div>

                    </div>



                </div>


            </div>

        </div>
    </div>
</div>





