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
<div class="col-md-1"></div>
<div class="col-md-7">
    <h3>请在下面录入你要添加的标签信息</h3>
    <form action="/admin_aAticleLabel" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">文章ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="label_name" name="article_id" value="{{ $article }}">
            </div>
        </div>

        <div class="form-group">
            <label for="" class="col-sm-3 control-label">标签名</label>
            <div class="col-sm-offset-2 col-sm-10">
                <select class="form-control" name="label_id">
                    @foreach($label_data as $data)
                    @if($data->relation_article != $article)
                    <option value="{{$data->label_id }}">{{ $data->label_name }}</option>
                    @else
                    <option value="{{$data->label_id }}" selected="selected">{{ $data->label_name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
                <!--<a  href="/admin_AddArticleToSubject" class="btn btn-primary btn-sm">确定</a>-->
                <button type="submit" class="btn btn-default">确定</button>
            </div>
        </div>

    </form>
</div>
@stop
