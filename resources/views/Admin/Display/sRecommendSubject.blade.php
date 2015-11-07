@extends("Admin.Display.base")


@section("main")
 <div class="col-sm-10">
        <div class="panel panel-default">
             <div class="panel-body">
                     <div class="col-sm-9">
                         <h2>推荐专题</h2>
                         <hr/>
                         <table class="table table-hover table-bordered">
                            <tr>
                                <th>专题ID</th>
                                  <th>专题名</th>
                                  <th>创建时间</th>
                                  <th>作者</th>
                                  <th>分类</th>
                                  <th>操作</th>
                            </tr>
                           
                                  @foreach($recommendData as $data)
                                   <tr>
                                  <td>{{$data->subject_id}}</td>
                                  <td>{{$data->subject_name }}</td>
                                  <td>{{$data->subject_create_date}}</td>
                                  <td>{{$data->user_nickname}}</td>
                                  <td>{{$data->class_name}}</td>
                                  <td>
                                       
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#upd_re_{{$data->recommend_id}}">
                                          修改推荐
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="upd_re_{{$data->recommend_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">修改推荐</h4>
                                              </div>
                                              <div class="modal-body">
                                                  <form action="/admin_uRecommendSubject" method="post">
                                                      <input type="hidden"name="_token"value="{{ csrf_token() }}">
                                                       <input type="hidden" name="recommend_id" value="{{ $data->recommend_id }}">
                                                       <div class="form-group">
                                                           <label>分类</label>
                                                          <select class="form-control" name="recommend_class">
                                                              @foreach($class_data as $value)
                                                                @if($value->class_id == $data->class_id)
                                                                    <option selected="selected" value="{{$value->class_id}}">{{$value->class_name}}</option>
                                                                @else
                                                                    <option value="{{$value->class_id}}">{{$value->class_name}}</option>
                                                                @endif
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
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#del_re_{{$data->recommend_id}}">
                                          移出推荐
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="del_re_{{$data->recommend_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                <a href="/admin_dRecommendSubject/{{$data->recommend_id}}" class="btn btn-danger">是的</a>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      
                                      
                                  </td>
                                  </tr>
                                  @endforeach
                            
                          </table>
                         <?php echo $recommendData->render();?>
                         
                         
                     </div>
                    <div class="col-sm-3">
                        <form class="form-inline" action="/admin_sRecommendSubject" method="get">
                          <div class="form-group">
                            <label class="sr-only">搜索</label>
                            <input type="text" class="form-control" name="search_subject" placeholder="按文章标题搜索">
                          </div>
                       
                          <button type="submit" class="btn btn-default">搜索</button>
                          
                          
                        </form>
                        <hr/>
                        <!-- Button trigger modal -->
                            <button type="button" class="btn btn-default " data-toggle="modal" data-target="#manage_class">
                             类别管理
                            </button>
                        


                            <!-- Single button -->
                            <div class="btn-group">
                              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                            </div>

                            

                            <!-- Modal -->
                            <div class="modal fade" id="manage_class" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">商品类别</h4>
                                  </div>
                                  <div class="modal-body">

                                      <div class="collapse" id="add_class">
                                        <div class="well">
                                           <form action="/admin_aDisplayClass" method="post">
                                                <div class="form-group">
                                                  <input type="hidden"name="_token"value="{{ csrf_token() }}">
                                                  <label >新增类别名</label>
                                                  <input type="text" class="form-control" name="class_name"placeholder="新增类别">
                                                </div>

                                              <button type="submit" class="btn btn-default">提交</button>
                                           </form>
                                        </div>
                                      </div>

                                      @foreach($class_data as $data)
                                          <div class="collapse" id="update_class_{{$data->class_id}}">
                                            <div class="well">
                                               <form action="/admin_uDisplayClass" method="post">
                                                    <div class="form-group">
                                                      <label >类别名</label>
                                                     <input type="hidden"name="_token"value="{{ csrf_token() }}">
                                                      <input type="text" class="form-control" name="class_name"placeholder="修改" value="{{$data->class_name}}">
                                                      <input type="hidden" class="form-control" name="class_id" value="{{$data->class_id}}">
                                                    </div>

                                                    <button type="submit" class="btn btn-default">确认修改</button>
                                                </form>
                                            </div>
                                          </div>
                                      @endforeach


                                      <table class="table table-hover">
                                            <tr>
                                                  <th>类名</th>
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
                                                      <a href="admin_dDisplayClass/{{$data->class_id}}" class="btn btn-danger" >删除</a>


                                                  </td>
                                            </tr>    
                                            @endforeach
                                      </table>

                                  </div>
                                  <div class="modal-footer">
                                      <a class="btn btn-primary" role="button" data-toggle="collapse" href="#add_class" aria-expanded="false" aria-controls="add_class">
                                        新增
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