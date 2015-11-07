@extends("User.PersonalMessage.base")
@section("main")




<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>查看个人信息</h2>
            <hr/>


            <table class="table table-striped">
                <thead>
                    <tr>             
                        <th>密码</th>
                        <th>昵称</th>               
                        <th>更改日期</th>
                        <th>年龄</th>                                        
                        <th>简介</th>
                        <th>性别</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                 
                    <tr>
                        <td>{{ $personalMessage->user_password}}</td>
                        <td>{{ $personalMessage->user_nickname}}</td>
                        <td>{{ $personalMessage->user_update_date}}</td>
                        <td>{{ $personalMessage->user_age}}</td>
                        <td>{{ $personalMessage->user_intro}}</td>
                        <td>{{ $personalMessage->user_sex}}</td>
                        <td>
                            <a href="/user_uPersonalMessage" class="btn btn-warning btn-sm">修改</a>               
                      </td>
                    </tr>
                
                </tbody>
            </table>



        </div>
    </div>
</div>


@stop

