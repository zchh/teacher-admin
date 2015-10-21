@extends("Admin.base")
@section("body")
<form class="navbar-form navbar-right">
    <input type="text" class="form-control" placeholder="Search...">
</form>
<div class="col-sm-3 col-md-2 sidebar">

    <ul class="nav nav-sidebar">
        <li class="active"><a href="#">添加文章 <span class="sr-only">(current)</span></a></li>
        <li><a href="#">添加标签</a></li>
        <li><a href="#">查看所有标签</a></li>
    </ul>
    <ul class="nav nav-sidebar">
        <li><a href="/admin_sSubject">查看所有的专题</a></li>
        <li><a href="/admin_aSubject">添加专题</a></li>
        <li><a href="">添加一篇文章到专题</a></li>
        <li><a href="">待续.....</a></li>
    </ul>
</div>
<h2 class="sub-header">文章类别列表</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>序号</th>
                <th>类别名字</th>
                <th>此类文章作者</th>
                <th>创建日期</th>
                <th colspan="3">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subject_data as $key => $data)
            <tr>
                <td>{{ $data->subject_id }}</td>
                <td>{{ $data->subject_name }}</td>
                <td>{{ $data->subject_intro }}</td>
                <td>{{ $data->subject_create_date }}</td>
                <td colspan="3"><a class="btn btn-default" href="/admin_uSubject/{{ $data->subject_id  }}">Edit</a>
                    <a class="btn btn-primary" href="/admin_sSubject/{{ $data->subject_id  }}">Delete</a>
                    <a class="btn btn-info" href="/admin_moreSubject/{{ $data->subject_id }}">详情页</a>
                </td>
                <!--<td><a href="/admin_sSubject/{{ $data->subject_id  }}">Delete</a></td>
                <td><a class="btn btn-info" href="/admin_moreSubject/{{ $data->subject_id }}">详情页</a></td>-->
            </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
</div>
</div>
</div>
@show
@stop