@extends("User.Article.base")
@section("main")




<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-body">

            <h2 class="sub-header">当前专题：{{$moreSubject[0]->subject_name}} | <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#add_article_{{$moreSubject[0]->subject_id}}">添加文章</button></h2>
            <div class="modal fade" id="add_article_{{$moreSubject[0]->subject_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">请选择要添加的文章</h4>
                        </div>
                        <form action="/user_addArticleToSubject" method="post">
                            <div class="modal-body">            

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="subject_id" value="{{$moreSubject[0]->subject_id}}">   
                                @foreach($checkArticle as $value1)   
                                @if(!in_array($value1->article_id,$article_ids))
                                <h4><input type="checkbox" name="article_id_array[]"  value="{{$value1->article_id}}" > {{$value1->article_title}}</input></h4>
                                @endif
                                @endforeach       
                            </div>
                            <div class="modal-footer">
                                <button  class="btn btn-primary " type="submit">添加</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <hr>

            <div class="col-sm-7">
                <table class="table">
                    <thead>
                        <tr>
                            <th>现有文章</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    @foreach($moreSubject as $data)
                    @if($data->relation_subject!=NULL)
                    <tbody>
                        <tr>
                            <td>{{ $data->article_title }}</td>
                            <td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del_{{$data->subject_id}}">
                                    移除
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="del_{{$data->subject_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">警告！</h4>

                                            </div>
                                            <div class="modal-body">
                                                将要移除该文章！
                                            </div>
                                            <div class="modal-footer">
                                                <a href="/user_removeArticleToSubject/{{ $data->subject_id }}/{{ $data->article_id }}" class="btn btn-danger btn-sm">移除</a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                            </div>

                                        </div>
                                    </div>
                                </div></td>      
                        </tr>
                    </tbody>

                    @endif
                    @endforeach
                </table>
            </div>


            <div class="col-sm-3 ">
                <div class="panel panel-default ">
                    <div class="panel-body ">
                        <h3 class="container">专题介绍</h3>
                        <hr>
                        @foreach($moreSubject as $data)
                        <h4 class="container">{{ $data->subject_intro }}</h4>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
