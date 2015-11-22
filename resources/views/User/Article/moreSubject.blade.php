@extends("User.Article.base")
@section("main")




<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-body">

            <h2 class="sub-header">当前专题：{{$subjectDetail->subject_name}} | <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#add_article_{{$subjectDetail->subject_id}}">添加文章</button></h2>
            <div class="modal fade" id="add_article_{{$subjectDetail->subject_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">请选择要添加的文章</h4>
                        </div>
                        <form action="/user_addArticleToSubject" method="post">
                            <div class="modal-body">            

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="subject_id" value="{{$subjectDetail->subject_id}}">   
                                @foreach($canSelectArticle as $data)
                                    @if($data->relation_id ==NULL)
                                    <h4><input type="checkbox" name="article_id_array[]"  value="{{$data->article_id}}" > {{$data->article_title}}</input></h4>
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

            <div class="col-sm-12">
                <table class="table table-hover table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>现有文章</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <?php 
                    $len = sizeof($subjectArticle);
                    foreach($subjectArticle as $key=>$data)
                    {
                        
                        
                    ?>
                   
                   
                    <tbody>
                        <tr>
                            <td><a href="/index_articleDetail/{{ $data->article_id }}">{{ $data->article_title }}</a></td>
                            <td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del_a_{{$subjectDetail->subject_id}}">
                                    移除
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="del_a_{{$subjectDetail->subject_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                                <a href="/user_removeArticleToSubject/{{$subjectDetail->subject_id}}/{{ $data->article_id }}" class="btn btn-danger btn-sm">移除</a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @if($key != 0)
                                <a href="/user_setSubjectArticleSort/{{ $data->relation_id }}/1" class="btn btn-default btn-sm" >
                                    上移
                                </a>
                                @endif
                                 @if($key != $len-1)
                                <a href="/user_setSubjectArticleSort/{{ $data->relation_id }}/0" class="btn btn-default btn-sm" >
                                    下移
                                </a>
                                 @endif
                            
                            </td>      
                        </tr>
                    </tbody>

                    <?php }?>
                </table>
            </div>


           
        </div>
    </div>
</div>

 <div class="col-sm-2 ">
    <div class="panel panel-default ">
        <div class="panel-body ">
            <h3 class="container">专题介绍</h3>
            <hr>
            {{$subjectDetail->subject_intro}}
            <hr>
            创建时间：<br>{{$subjectDetail->subject_create_date}}<br>
            修改时间：<br>{{$subjectDetail->subject_create_date}}<br>
            点击量：{{$subjectDetail->subject_click}}

        </div>
    </div>
</div>

@stop
