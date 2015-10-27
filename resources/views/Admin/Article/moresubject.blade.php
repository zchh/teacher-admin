@extends("Admin.Article.base")
@section("main")

<div class="col-md-1">专题详情</div>
<div class="col-sm-7">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>专题ID</th>
                <th>专题名</th>
                <th>专题介绍</th>
                <th>专题对应文章主题</th>
                <th>专题对应文章介绍</th>
                <th>操作</th>
            </tr>
        </thead>
        @foreach($article_by_subject as $data)
        <tbody>
            <tr>
                <td>{{ $data->subject_id }}</td>
                <td>{{ $data->subject_name }}</td>
                <td>{{ $data->subject_intro }}</td>
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