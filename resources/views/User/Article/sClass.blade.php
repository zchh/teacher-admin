@extends("User.Article.base")
@section("main")
 
        <div class="col-sm-8">
            <div class="panel panel-default">
                     <div class="panel-body">
                         <h2>查看类别</h2>
                         <hr/>
                
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>用户</th>
                                        <th>创建日期</th>
                                        <th>更改日期</th>
                                        <th>类名</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($userArticleClass as $articleClass)                      
                                    <tr>
                                        <td>{{$articleClass -> class_id}}</td>
                                        <td>{{$articleClass -> user_nickname}}</td>
                                        <td>{{$articleClass -> class_create_date}}</td>
                                        <td>{{$articleClass -> class_update_date}}</td>
                                        <td>{{$articleClass -> class_name}}</td>
                                        <td>
                                            <a href="" class="btn btn-default">修改</a>
                                            <a href="" class="btn btn-default">删除</a>
                                            <a href="" class="btn btn-default">添加</a></td>
                                    </tr>
                                     @endforeach
                                 
                                </tbody>
                            </table>
       
@stop
        





