@extends("Admin.Article.base")
@section("main")
<!-- 导航条  -->

<div class="col-sm-10">
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="navbar-form navbar-right" action="/admin_sArticleByCondition" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label class=""><font color="orange">查找条件</font></label>
                <select class="form-control" name="condition">
                    <option value="article_create_date">日期</option>
                    <option value="article_title">文章主题</option>
                </select>
                <input type="text" class="form-control" name="search" placeholder="Search...">
                <button type="submit" class="btn btn-info">查询</button>
            </form>
            <h2 class="sub-header">文章列表</h2><hr>
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
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal{{$data->article_id}}">
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
                                            <form class="form-horizontal" action="/admin_AddArticleToSubject" method="post">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">文章ID</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="article" value="{{$data->article_id}}" placeholder="{{$data->article_id}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">添加到</label>
                                                        <div class="col-sm-10">
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
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add{{$data->article_title}}">
                                    并入标签
                                </button>
                                <!-- Modal2 -->
                                <div class="modal fade" id="add{{$data->article_title}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">并入标签</h4>
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
                                </div>
                                <a class="btn btn-danger btn-sm" href="/admin_dArticle/{{ $data->article_id }}" role="button">删除文章</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->

@stop