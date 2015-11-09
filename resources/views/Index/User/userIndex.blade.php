@extends("Index.base")
@section("main")

<div class="col-sm-8 col-sm-offset-2">



    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-sm-12" style="background:url('/Public/2h.jpg');
                 background-size:100% 100%;height:300px;border: 1px solid gray;
                 border-radius:10px;	">
                <div style="margin: 15px auto; width:150px;height:150px">
                    <img src="{{$userData->image_path}}" class="img-circle" style="margin:auto ;width:100%;height:100%">
                </div>
                <div style="width:150px;height:100px;margin:15px auto;" >
                    <h3 style="text-align: center;color:white">{{$userData->user_username}}</h3>
                    
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




                        </div>
                        <div role="subject" class="tab-pane fade " id="subject">
                            @foreach($subjectData as $data)

                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-sm-8">
                                        <h4>{{$data->subject_name}} </h4><small> | {{$data->subject_create_date}}.</small><br>
                                        {{$data->subject_intro}}
                                    </div>
                                    <div class="col-sm-4">
                                        <img src="/Public/2h.jpg" class="img-responsive img-rounded">

                                    </div>
                                    <div class="col-sm-12">
                                        <a href="/index_moreSubject/{{$data->subject_id}}" class="btn btn-default  ">查看详情</a>
                                    </div>

                                </div>
                            </div>



                            @endforeach
                        </div>
                        <div role="image" class="tab-pane  fade" id="image">
                            sadaddasdasd
                        </div>

                    </div>

                </div>


            </div>

        </div>
    </div>
</div>





