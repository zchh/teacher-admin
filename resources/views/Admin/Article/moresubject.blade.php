@extends("Admin.base")
@section("body")
<div class="col-sm-3 col-md-2 sidebar">

    <ul class="nav nav-sidebar">
        <li class="active"><a href="/admin_sArticle">查看文章 <span class="sr-only">(current)</span></a></li>
        <li><a href="/admin_aLebel">添加标签</a></li>
        <li><a href="/admin_sLebel">查看所有标签</a></li>
    </ul>
    <ul class="nav nav-sidebar">
        <li><a href="/admin_sSubject">查看所有的专题</a></li>
        <li><a href="/admin_aSubject">添加专题</a></li>
        <li><a href="">添加一篇文章到专题</a></li>
        <li><a href="">待续.....</a></li>
    </ul>
</div>
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
                <td><a href="/admin_RemoveArticleToSubject/{{ $data->subject_id }}/{{ $data->article_id }}" class="btn btn-info btn-sm">[移除该文章]</a></td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@stop