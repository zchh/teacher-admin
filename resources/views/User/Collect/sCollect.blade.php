@extends("User.Article.base")
@section("main")




<div class="col-sm-10">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-sm-9">
                <h2>收藏的文章</h2>
                <hr/>
                <table class="table table-hover table-bordered">
                    <tr>
                        <th>文章ID</th>
                        <th>文章名</th>
                        <th>文章创建时间</th>
                        <th>作者</th>
                        <th>分类</th>
                        <th>操作</th>
                    </tr>

                    @foreach($collectData as $data)
                    <tr>
                        <td>{{$data->article_id}}</td>
                        <td>{{$data->article_title }}</td>
                        <td>{{$data->article_create_date}}</td>
                        <td>{{$data->user_nickname}}</td>
                        <td>{{$data->class_name}}</td>
                        <td>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#upd_re_{{$data->collect_id}}">
                                修改
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="upd_re_{{$data->collect_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">修改推荐</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/user_uCollect" method="post">
                                                <input type="hidden"name="_token"value="{{ csrf_token() }}">
                                                <input type="hidden" name="collect_id" value="{{ $data->collect_id }}">
                                                <div class="form-group">
                                                    <label>分类</label>
                                                    <select class="form-control" name="collect_class">
                                                        @foreach($classData as $value)
                                                        <option type="select" value="{{$value->class_id}}" selected="selected">{{$value->class_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                            <button type="submit" class="btn btn-primary">确认</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#del_re_{{$data->collect_id}}">
                                移出推荐
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="del_re_{{$data->collect_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">删除</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h4>确定要取消该项的推荐</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                            <a href="/user_dCollect/{{$data->collect_id}}" class="btn btn-danger">是的</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        <div class="col-sm-3">
                        <form class="form-inline" action="/user_sArticle" method="get">
                          <div class="form-group">
                            <label class="sr-only">搜索</label>
                            <input type="text" class="form-control" name="search_article" placeholder="按文章标题搜索">
                          </div>
                       
                          <button type="submit" class="btn btn-default">搜索</button>
                          
                          
                        </form>
                        <hr/>
                         <!-- Button trigger modal -->
                            <button type="button" class="btn btn-default " data-toggle="modal" data-target="#manage_class">
                             收藏夹管理
                            </button>
                        


                            <!-- Single button -->
                            

                            

                            <!-- Modal -->
                            <div class="modal fade" id="manage_class" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">收藏夹</h4>
                                  </div>
                                  <div class="modal-body">

                                      <div class="collapse" id="add_class">
                                        <div class="well">
                                           <form action="/user_aCollectClass" method="post">
                                                <div class="form-group">
                                                  <input type="hidden"name="_token"value="{{ csrf_token() }}">
                                                  <label >添加收藏夹</label>
                                                  <input type="text" class="form-control" name="class_name"placeholder="收藏夹名称">
                                                </div>

                                              <button type="submit" class="btn btn-default">提交</button>
                                           </form>
                                        </div>
                                      </div>

                                      @foreach($class_data as $data)
                                          <div class="collapse" id="update_class_{{$data->class_id}}">
                                            <div class="well">
                                               <form action="/user_uCollectClass" method="post">
                                                    <div class="form-group">
                                                      <label >收藏夹名称</label>
                                                     <input type="hidden"name="_token"value="{{ csrf_token() }}">
                                                      <input type="text" class="form-control" name="class_name" placeholder="修改" value="{{$data->class_name}}">
                                                      <input type="hidden" class="form-control" name="class_id" value="{{$data->class_id}}">
                                                    </div>

                                                    <button type="submit" class="btn btn-default">确认修改</button>
                                                </form>
                                            </div>
                                          </div>
                                      @endforeach


                                      <table class="table table-hover">
                                            <tr>
                                                  <th>收藏夹</th>
                                                  <th>操作</th>
                                            </tr>
                                            @foreach($class_data as $data)
                                            <tr>
                                                  <td>{{$data->class_name}}</td>
                                                  <td>
                                                      <a class="btn btn-primary" role="button" data-toggle="collapse" 
                                                         href="#update_class_{{$data->class_id}}" 
                                                         aria-expanded="false" aria-controls="update_class_{{$data->class_id}}">
                                                        修改
                                                      </a>
                                                      <a href="user_dCollectClass/{{$data->class_id}}" class="btn btn-danger" >删除</a>


                                                  </td>
                                            </tr>    
                                            @endforeach
                                      </table>

                                  </div>
                                  <div class="modal-footer">
                                      <a class="btn btn-primary" role="button" data-toggle="collapse" href="#add_class" aria-expanded="false" aria-controls="add_class">
                                        添加
                                      </a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>

                                  </div>
                                </div>
                              </div>
                            </div>
                         


                    </div>
              </div>
        </div>
</div>
                                                                                @stop
