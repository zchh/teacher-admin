@extends("Admin.Article.base")
@section("main")
<!-- 导航条  -->

<div class="col-sm-10">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2 class="sub-header">文章列表</h2>
            <div class="pull-left">
                <a href="/user_aArticle" class="btn  btn-primary btn-sm" >添加文章</a>
                <!-- Single button -->
                <!--<div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        分类 <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="/admin_sArticle?class=&sort={{$sort}}">所有分类</a></li>
                        @foreach($class_data as $class_value)
                        <li><a href="/admin_sArticle?class={{$class_value->class_id}}&sort={{$sort}}&key={{$key}}"></a></li>
                        @endforeach
                    </ul>

                </div>-->
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        排序{{$sort}}   <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">

                        <li><a href="/admin_sArticle?sort=article_id&key={{$key}}">最近发表</a></li>
                        <li><a href="/admin_sArticle?sort=article_sort&key={{$key}}">最高优先级</a></li>

                    </ul>
                </div>
            </div>

            <div class="pull-right" style="position: relative;top:-8px">

                <form class="navbar-form navbar-left" method="get" action="/admin_sArticle">
                    <div class="form-group">
                        <input type="text" class="form-control" name="key" placeholder="按标题搜索文章" value="{{$key}}">
                        <input type="hidden" name="sort" value="{{$sort}}">
                    </div>
                    <button type="submit" class="btn btn-default " >搜索</button>
                    @if($key != NULL)
                    <div class="pull-right" style="padding-top: 5px;padding-left: 5px">
                        <a href="/admin_sArticle?sort={{$sort}}&key=" class="label label-primary" style="display: block;height:60%;margin-left:5px;float:left">
                            当前搜索{{$key}} ：
                            <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                        </a>

                    </div>
                    @endif
                </form>
            </div>   


            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>文章标题</th>
                        <th>创建日期</th>
                        <th>更改日期</th>
                        <th>专题</th>                                        
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($article_data as $data)
                    <tr>
                        <td>{{$data->article_id}}</td>
                        <td>{{$data->article_title}}</td>
                        <td>{{$data->article_create_date}}</td>
                        <td>{{$data->article_update_date}}</td>
                        <td>{{$data->subject_name}}</td>

                        <td>
                            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal{{$data->article_id}}">
                                并入专题
                            </button>

                            <!-- Modal2 -->
                            <div class="modal fade" id="myModal{{$data->article_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">并入专题</h4>
                                        </div>
                                        <form action="/admin_AddArticleToSubject" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="form-group">
                                                <label for="" class="col-sm-2 control-label">文章ID</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="label_name" name="article" value="{{$data->article_id}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">并入到</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="subject">
                                                        @foreach($subject_data as $subject_value)
                                                        <option value="{{$subject_value->subject_id}}">{{$subject_value->subject_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <!--<a  href="/admin_AddArticleToSubject" class="btn btn-primary btn-sm">确定</a>-->
                                                    <button type="submit" class="btn btn-default">确定</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#add{{$data->article_id}}">
                                添加标签
                            </button>
                            <!-- Modal2 -->
                            <div class="modal fade" id="add{{$data->article_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">添加标签</h4>
                                        </div>
                                        <form action="/admin_aAticleLabel" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="form-group">
                                                <label for="" class="col-sm-2 control-label">文章ID</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="label_name" name="article_id" value="{{$data->article_id}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">并入到</label>
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <select class="form-control" name="label_id">
                                                        @foreach($label_data as $label_value)
                                                        <option value="{{$label_value->label_id}}">{{$label_value->label_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <!--<a  href="/admin_AddArticleToSubject" class="btn btn-primary btn-sm">确定</a>-->
                                                    <button type="submit" class="btn btn-default">确定</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <a class="btn btn-danger btn-xs" href="/admin_dArticle/{{$data->article_id}}" role="button">删除文章</a>
                            @if($data->recommend_id==NULL)
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add_recommend_article{{$data->article_id}}">
                                推荐
                            </button>

                            <div class="modal fade" id="add_recommend_article{{$data->article_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">新增推荐文章</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/admin_aRecommendArticle" method="post">
                                                <div class="form-group">
                                                    <label>添加到</label>
                                                    <select class="form-control" name="recommend_class">
                                                        @foreach($recommend_class as $class_son_data)
                                                        <option value="{{$class_son_data->class_id}}">{{$class_son_data->class_name}}</option>
                                                        @endforeach

                                                    </select>

                                                    <input name="article_id" value="{{ $data->article_id }}" type="hidden">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                </div>  
                                        </div>
                                        <div class="modal-footer">
                                            <a  class="btn btn-default" data-dismiss="modal">关闭</a>
                                            <button type="submit" class="btn btn-primary">提交</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <?php echo $pageGui; ?><br>
            <b>当前第 {{$now_page}} 页 | 共 {{$all_page}} 页</b>

        </div>
    </div>
</div>



@stop
