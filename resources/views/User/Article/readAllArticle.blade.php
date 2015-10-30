
@extends("User.Article.base")
@section("main")
    
    

        <div class="col-sm-10">
            <div class="panel panel-default">
                     <div class="panel-body">
                         <h2>查看其他用户所有文章</h2>
                         <hr/>
                         <table class="table table-hover">
                            <tr>
                                  <th></th>
                            </tr>
                          </table>

                         
                     </div>
                <table class="table  table-hover">
                 
                    <tr>
                        <td>标号</td>
                        <td>发表时间</td>
                        <td>更新时间</td>
                        <td>文章标题</td>
                        <td>文章简介</td>
                        <td>用户昵称</td>
                        <td>
                          操作
                        </td> 
                        
                    </tr>
                    
                    @foreach($articleData  as $data)
                         <tr>
                        <td>{{$data -> article_id}}</td>
                        <td>{{$data -> article_create_date}}</td>
                        <td>{{$data -> article_update_date}}</td>
                        <td>{{$data -> article_user}}</td>
                        <td>{{$data -> article_title}}</td>
                        <td>{{$data -> article_intro}}</td>
                        <td>
                          <a class="btn btn-default" href="/user_readSingleArticle/{{$data -> article_id}}">查看详情</a>
                        </td> 
                    </tr>
                    @endforeach
                </table>
                 <?php echo $articleData->render(); ?>
            </div>
            
           
        </div>
                         
                          
        

@stop
