
@extends("User.Article.base")
@section("main")



<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>查看其他用户所有文章</h2>

            <hr>


            <table class="table  table-striped">
                <thead>
                    <tr>
                        <th>文章标题</th>
                        <th>发表时间</th>
                        <th>更新时间</th>
                        <th>文章简介</th>
                        <th>作者</th>
                        <th>操作</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($articleData  as $data)
                    <tr>
                        <td>{{$data -> article_title}}</td>
                        <td>{{$data -> article_create_date}}</td>
                        <td>{{$data -> article_update_date}}</td>
                        <td>{{$data -> article_intro}}</td>
                        <td>{{$data->user_nickname}}</td>
                        <td>
                            <a class="btn btn-sm btn-info" href="/user_readSingleArticle/{{$data -> article_id}}">查看详情</a>
                            
                            
                            
                        </td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <?php echo $articleData->render(); ?>
        </div>


    </div>




    @stop
