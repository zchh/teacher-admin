@extends("User.Image.base")
 @section("left_nav")
    <div class="col-sm-2 ">
        
        <div class="col-sm-12" style="height:20px"></div>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading " style="text-align:center"><h2>图片分类</h2></div>
            <div class="panel-body" >
              <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#manage_class">
                                    <span class="glyphicon glyphicon-tags" aria-hidden="true"></span>  
                                    分类管理
                                </button>
                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#add_">
                                    <span class="glyphicon glyphicon-picture" aria-hidden="true"></span> 
                                     添加图片
                                </button>

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
                                               <form action="/user_aImageClass" method="post">
                                                    <div class="form-group">
                                                      <input type="hidden"name="_token"value="{{ csrf_token() }}">
                                                      <label >新增类别名</label>
                                                      <input type="text" class="form-control" name="class_name"placeholder="新增类别">
                                                    </div>

                                                  <button type="submit" class="btn btn-default">提交</button>
                                               </form>
                                            </div>
                                          </div>

                                          @foreach($imageClassData as $data)
                                              <div class="collapse" id="update_class_{{$data->class_id}}">
                                                <div class="well">
                                                   <form action="/user_uImageClass" method="post">
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


                                          <table class="table table-hover" >
                                                <tr>
                                                      <th>类名</th>
                                                      <th>操作</th>
                                                </tr>
                                                @foreach($imageClassData as $data)
                                                <tr>
                                                      <td>{{$data->class_name}}</td>
                                                      <td>
                                                          <a class="btn btn-primary" role="button" data-toggle="collapse" 
                                                             href="#update_class_{{$data->class_id}}" 
                                                             aria-expanded="false" aria-controls="update_class_{{$data->class_id}}">
                                                            修改
                                                          </a>
                                                          <a href="/user_dImageClass/{{$data->class_id}}" class="btn btn-danger" >删除</a>


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

            <table class="table table-hover" style="text-align:center">
               <tr>
                <td> <a href="/user_sImage">全部</a></td>
               </tr>
               @foreach($imageClassData as $data)
               <tr>
                <td> <a href="/user_sImage?class_id={{$data->class_id}}">{{$data->class_name}}</a></td>
               </tr>
               @endforeach
          </table>
         </div>


    </div>

@stop


@section("main")

<div class="col-sm-10">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>图片库<small> | {{$nowClass}}</small></h2> 
            <hr/>


            <table class="table table-striped">
                <thead>

                </thead>
                <tbody>

                    @foreach($base_image as  $data)

                <div class="col-sm-6 col-md-4" style="height:500px">
                    
                        <img src="/getImage/{{$data -> image_id}}" alt="..." class="img-responsive img-rounded" style="height:60%">
                        <div class="caption">
                            <h3>{{$data -> image_name}}</h3>
                            <p>{{$data -> image_intro}}</p>
                            <p>
                                <a type="button" class="btn btn-danger " data-toggle="modal" data-target="#delete_{{ $data->image_id}}">
                                    删除
                                </a>
                                <a type="button" class="btn btn-default" data-toggle="modal" data-target="#update_{{ $data->image_id}}">
                                    修改
                                </a>
                            </p>
                        </div>
 
                </div>


                <!-- Button trigger modal -->

                <!-- Modal -->
                <div class="modal fade" id="delete_{{ $data->image_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">删除类别</h4>
                            </div>
                            <div class="modal-body">
                                确定要删除吗？               
                            </div>
                            <form>

                                <div class="modal-footer">
                                    <a href="/user_dImage/{{ $data->image_id}}" class="btn btn-danger" name="delete">确定删除</a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>




                <!-- Button trigger modal -->

                <!-- Modal -->
                <div class="modal fade" id="update_{{ $data->image_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">修改图片文件</h4>
                            </div>
                            <div class="modal-body">
                                <form method="get" action="/user_uImage">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <div>
                                            <label for="exampleInputFile">图片名</label>
                                            <?php echo "<br/> "; ?>
                                            <input type="text" class="form-control" name="image_name" value="{{$data -> image_name}}">   
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">分类夹</label>
                                            <select class="form-control" name="image_class">
                                                @foreach($imageClassData as $value)
                                                    @if($value->class_id ==  $data->image_class)
                                                        <option value = "{{$value->class_id}}" selected="selected">{{$value->class_name}}</option>
                                                    @else
                                                        <option value = "{{$value->class_id}}" >{{$value->class_name}}</option>
                                                    @endif
                                                @endforeach

                                            </select>
                                        </div>
                                        <div>
                                            <label for="exampleInputFile">图片介绍</label>
                                            <textarea class="form-control" rows="2" name="image_intro" >{{$data -> image_intro}}</textarea> 
                                        </div>

                                        <input type="hidden" value="{{$data -> image_id}}" name="image_id">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default">提交</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>






                @endforeach
                </tbody>
            </table>



        </div>
    </div>
</div>
<div class="col-sm-2">
    <div class="panel panel-default">
        <div class="panel-body">
            <!-- Button trigger modal -->
        

            <!-- Modal -->
            <div class="modal fade" id="add_" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">添加图片</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="/user_aImage" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                                <div class="form-group">
                                    <label >请选择你要上传的图片文件</label>
                                    <input type="file" id="exampleInputFile" name="image_file">                              
                                </div>
                                <div class="form-group">
                                    <label >请输入图片名</label>
                                    <?php echo "<br/>"; ?>
                                    <input type="text" class="form-control" name="image_name">                              
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">分类夹</label>
                                    <select class="form-control" name="image_class">
                                        @foreach($imageClassData as $data)
                                            <option value = "{{$data->class_id}}">{{$data->class_name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputFile">请输入你对上传图片的描述</label>
                                    <textarea class="form-control" rows="2" name="image_intro"></textarea>                              
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-8 col-md-offset-2" >
    <?php echo $base_image->render(); ?>  
</div>

@stop
