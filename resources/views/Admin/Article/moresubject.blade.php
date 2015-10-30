@extends("Admin.Article.base")
@section("main")




<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">文章添加</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/admin_AddArticleToSubject2" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="subject_id" value="{{$subject_by_id->subject_id}}">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">选择文章</label>
                        <div class="col-sm-10">
                            @foreach($all_article_data as $all_article)
                            @if(!in_array($all_article->article_id,$article_ids))
                            <h4><input type="checkbox" name="article_id_array[]"  value="{{$all_article->article_id}}" > {{$all_article->article_id}} : {{$all_article->article_title}}</input></h4>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-default">添加</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="col-sm-5">
    <h2>当前专题：{{$subject_by_id->subject_name}} | <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            添加文章
        </button></h2>
    <hr>
</div>

<div class="col-sm-7">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>文章ID</th>
                <th>文章创建日期</th>
                <th>文章修改日期</th>
                <th>文章主题</th>
                <th>文章介绍</th>
                <th>操作</th>
            </tr>
        </thead>
        @foreach($article_by_subject as $data)
        <tbody>
            <tr>
                <td>{{ $data->article_id }}</td>
                <td>{{ $data->article_create_date }}</td>
                <td>{{ $data->article_update_date }}</td>
                <td>{{ $data->article_title }}</td>
                <td>{{ $data->article_intro }}</td>
                @if($article_by_subject[0]->article_id != null)
                <td><a class="btn btn-danger btn-sm" href="/admin_RemoveArticleToSubject/{{ $data->subject_id }}/{{ $data->article_id }}" class="btn btn-danger">[移除该文章]</a></td>
                @else
                <td></td>
                @endif
            </tr>
        </tbody>
        @endforeach
    </table>
</div>

@stop