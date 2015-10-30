@extends("Admin.Article.base")
@section("main")

<div class="col-sm-7">
    <h2>当前专题：{{$subject_by_id->subject_name}}</h2>
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
                <td><a href="/admin_RemoveArticleToSubject/{{ $data->subject_id }}/{{ $data->article_id }}" class="btn btn-info btn-sm">[移除该文章]</a></td>
                @else
                <td class="btn btn-info btn-sm">无文章</td>
                @endif
            </tr>
        </tbody>
        @endforeach
    </table>
</div>

@stop