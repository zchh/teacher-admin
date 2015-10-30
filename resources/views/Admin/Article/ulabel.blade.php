@extends("Admin.Article.base")
@section("main")

<div class="col-md-1"></div>
<div class="col-md-7">
    <h2>文章标签信息</h2>
    <form class="form-horizontal" action="/_admin_uLabel" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">标签ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="label_id" name="label_id" value="{{ $labelData_by_labelId[0]->label_id }}">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">标签名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="label_name" name="label_name" value="{{ $labelData_by_labelId[0]->label_name }}">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">标签更新日期</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="label_update_date" name="label_update_date" value="{{ $labelData_by_labelId[0]->label_update_date }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" id="label" class="btn btn-info">更新</button>
            </div>
        </div>
    </form>
</div>
@stop
