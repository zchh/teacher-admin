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
    <form class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="" class="col-sm-2 control-label"><font color="red">标签名</font></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="label_name" value="">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label"><font color="red">标签创建日期</font></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="label_create_date" value="">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" id="label" class="btn btn-danger">添加</button>
            </div>
        </div>
    </form>
</div>
<?php echo $ajax_request ?>
@stop
