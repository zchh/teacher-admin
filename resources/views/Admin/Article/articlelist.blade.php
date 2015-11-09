@extends("Admin.Article.base")
@section("main")
<!-- 导航条  -->

<div class="col-sm-10">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-sm-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2 class="sub-header">文章列表</h2>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>文章ID</th>
                                        <th>文章主题</th>
                                        <th>创建日期</th>
                                        <th>文章介绍</th>
                                        <th>所属专题</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($article_data as $data)
                                    <tr>
                                        <td>{{ $data->article_id }}</td>
                                        <td>{{ $data->article_title }}</td>
                                        <td>{{ $data->article_create_date }}</td>
                                        <td>{{ $data->article_intro }}</td>
                                        <td>{{ $data->subject_name }}</td>

                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal{{$data->article_id}}">
                                                并入专题
                                            </button>


                                            <!-- Modal1 -->
                                            <div class="modal fade" id="myModal{{$data->article_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">并入专题</h4>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">添加到</label>
                                                        <div class="col-sm-10"><input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <select class="form-control" name="subject">
                                                                @foreach($subject_data as $subject)
                                                                <option value="{{$subject->subject_id}}">{{$subject->subject_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <!--<a  href="/admin_AddArticleToSubject" class="btn btn-primary btn-sm">确定</a>-->
                                                    <button type="submit" class="btn btn-default">确定</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#add{{$data->article_id}}">
                                    并入标签
                                </button>
                                <!-- Modal2 -->
                                <div class="modal fade" id="add{{$data->article_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">并入标签</h4>

                                            </div>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add{{$data->article_id}}">
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
                                                                        @foreach($label_data as $label)
                                                                        <option value="{{$label->label_id}}">{{$label->label_name}}</option>
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


                                                <div class="form-group">
                                                    <label for="" class="col-sm-3 control-label">并入到</label>
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <select class="form-control" name="label_id">
                                                            @foreach($label_data as $label)
                                                            <option value="{{$label->label_id}}">{{$label->label_name}}</option>
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
                                @if($data->recommend_id==NULL)
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add_recommend_article{{$data->article_id}}">
                                    推荐
                                    </button>

                                    <!-- Modal -->
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
                                <a class="btn btn-danger btn-xs" href="/admin_dArticle/{{ $data->article_id }}" role="button">删除文章</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                            <?php echo $article_data->render(); ?>

            </div>
            <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!--<div class="col-sm-12" style="height:20px"></div>
                        <div class="btn-group col-sm-6">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                排序方式 <span class="caret"></span>
                            </button><br/>
                            <ul class="dropdown-menu">
                                <li><a href="">ID倒叙</a></li>
                                <li><a href="">创建时间</a></li>
                            </ul>
                        </div>-->
                        
                        <div class="btn-group col-sm-6">
                            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                筛选类别<span class="caret"></span>
                            </button><br/>
                            <ul class="dropdown-menu">
                                <li><a href="/admin_sArticleByClass?class_name=all">全部类别</a></li>
                                @foreach($class_data as $class)
                                <li><a href="/admin_sArticleByClass?class_name={{$class->class_id}}">{{$class->class_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-sm-12" style="height:20px"></div>
                        <form action="/admin_sArticleByCondition" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-sm-12">   
                                <input type="text" class="form-control" name="article_title"  placeholder="搜索主题关键字...">
                            </div>
                            <div class="col-sm-12" style="height:20px"></div>
                            <button type="submit" class="btn btn-default pull-right">搜索</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Button trigger modal -->


@stop
