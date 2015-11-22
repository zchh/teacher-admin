@extends("User.Article.base")
@section("main")
    
  


        <div class="col-sm-10">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>查看文章</h2> 
                    <div class="pull-left">
                        <a href="/user_aArticle" class="btn  btn-primary btn-sm" >添加文章</a>
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                分类 <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="/user_sArticle?class=&sort={{$sort}}">所有分类</a></li>
                                @foreach($classData as $data)
                                <li><a href="/user_sArticle?class={{$data->class_id}}&sort={{$sort}}&key={{$key}}">{{$data->class_name}}</a></li>
                                @endforeach

                            </ul>

                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                排序 {{$sort}}  <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">

                                <li><a href="/user_sArticle?class={{$class}}&sort=article_id&key={{$key}}">最近发表</a></li>
                                <li><a href="/user_sArticle?class={{$class}}&sort=article_sort&key={{$key}}">最高优先级</a></li>

                            </ul>
                        </div>
                    </div>

                    <div class="pull-right" style="position: relative;top:-8px">
                        
                        <form class="navbar-form navbar-left" method="get" action="/user_sArticle">
                            <div class="form-group">
                                <input type="text" class="form-control" name="key" placeholder="按标题搜索文章" value="{{$key}}">
                                <input type="hidden" name="class" value="{{$class}}">
                                <input type="hidden" name="sort" value="{{$sort}}">
                            </div>
                            <button type="submit" class="btn btn-default " >搜索</button>
                            @if($key!=NULL)
                            <div class="pull-right" style="padding-top: 5px;padding-left: 5px">
                                <a href="/user_sArticle?class={{$class}}&sort={{$sort}}&key=" class="label label-primary" style="display: block;height:60%;margin-left:5px;float:left">
                                    当前搜索 ：{{$key}}
                                    <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                                </a>
                                
                            </div>
                            @endif
                        </form>
                    </div>     
                    


                            <table class="table table-striped table-bordered ">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>文章标题</th>
                                        <th>创建日期</th>
                                        <th>更改日期</th>
                                        <th>类别</th>                                        
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($articleData as  $data)
                                    <tr>
                                        <td>{{ $data->article_id}}</td>
                                        <td><a href="/index_articleDetail/{{ $data->article_id }}">{{ $data->article_title }}</a></td>
                                        <td>{{ $data->article_create_date }}</td>
                                        <td>{{ $data->article_update_date }}</td>
                                        <td>{{ $data->class_name }}</td>
                                        <td>
                                            <a href="/user_uArticle/{{$data->article_id}}" class="btn btn-warning btn-xs">修改</a>
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#del_{{$data->article_id}}">
                                               删除
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="del_{{$data->article_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">警告!</h4>
                                                        </div>
                                                        <form class="form-horizontal" action="/admin_AddArticleToSubject" method="post">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <div class="modal-body">
                                                                将要删除此文章!
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                                                <a type="button" class="btn btn-danger" href="/user_dArticle/{{$data->article_id}}">删除</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                         <hr>
                         <?php echo $pageGui;?><br>
                         <b>当前第 {{$nowPage}} 页 | 共 {{$allPage}} 页</b>
                         
                      </div>
            </div>
        </div>

     
        
@stop
