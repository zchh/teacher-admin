@extends("Admin.base")
@section("body")
<form class="navbar-form navbar-right">
    <input type="text" class="form-control" placeholder="Search...">
</form>
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
<h2 class="sub-header">文章标签列表</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>序号</th>
                <th>标签名</th>
                <th>创建日期</th>
                <th>更新日期</th>
                <th colspan="3">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($label_data as $key => $data)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $data->label_name }}</td>
                <td>{{ $data->label_create_date }}</td>
                <td>{{ $data->label_update_date }}</td>
                <td colspan="3"><a class="btn btn-default" href="/admin_uLabel/{{$data->label_id}}">Edit</a>
                    <a class="btn btn-primary" href="/admin_dLebel/{{$data->label_id}}">Delete</a>
                    <a class="btn btn-info" href="">详情页</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <?php echo $label_data->render();?>
</div>
</div>
</div>
</div>
@show
@stop