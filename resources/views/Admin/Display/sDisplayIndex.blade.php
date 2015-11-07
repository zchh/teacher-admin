@extends("Admin.Display.base")


@section("main")
<div class="col-sm-10">
    <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-sm-9">
        
                <h2>展示的文章</h2>
                   <table class="table table-hover table-bordered">
                        <tr>
                              <th>展示ID</th>
                              <th>文章名</th>
                              <th>文章创建时间</th>
                              <th>作者</th>
                               <th>位置</th>
                              <th>操作</th>
                        </tr>
                        @foreach($indexData as $data)
                            @if($data->article_id!=NULL)
                            <tr>
                                <td>{{$data->display_id}}</td>
                                <td>{{$data->article_title}}</td>
                                <td>{{$data->article_create_date}}</td>
                                <td>{{$data->article_user}}</td>
                                <td>{{$data->display_location}}</td>
                                <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#upd_{{$data->display_id}}">
                                          修改
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="upd_{{$data->display_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">修改展示</h4>
                                              </div>
                                              <div class="modal-body">
                                               <form action="/admin_uDisplayIndex" method="post">
                                                      <input type="hidden" value="{{$data->display_id}}" name="display_id" >
                                                      <input type="hidden"name="_token" value="{{ csrf_token() }}">
                                                       <div class="form-group">
                                                            <label >添加到哪里展示</label>
                                                          <select class="form-control" name="display_location">
                                                              <option value="1" <?php if($data->display_location == 0){ echo ' selected="selected"'; } ?> >主页推荐</option>
                                                                <option value="2"  <?php if($data->display_location == 2){ echo ' selected="selected"'; } ?> >侧栏推荐</option>
                                                          </select>
                                                      </div>
                                                  
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                                <button type="submit" class="btn btn-primary">确定</button>
                                                    </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        
                                        
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#del_{{$data->display_id}}">
                                          移出
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="del_{{$data->display_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">移出一个展示</h4>
                                              </div>
                                              <div class="modal-body">
                                                  <h4>移出这一个展示?  <small> ID={{$data->display_id}}</small></h4>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                                <a href="/admin_dDisplayIndex/{{$data->display_id}}" class="btn btn-danger">确定移出</a>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    
                                </td>
                            </tr>
                            @endif
                        @endforeach
                   </table>
                </div>
                
                
                 <div class="col-sm-3">
        
               
                </div>
        </div>
    </div>
</div>

@stop