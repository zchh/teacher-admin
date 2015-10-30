@extends("User.Image.base")
@section("main")

<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2>图片库</h2> 
            <hr/>


            <table class="table table-striped">
                <thead>
                 
                </thead>
                <tbody>

                    @foreach($base_image as  $data)
                 
                     

                            
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <img src="{{$data -> image_path}}" alt="...">
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
                                                        <input type="text" class="form-control" name="image_user_name" value="{{$data -> image_name}}">   
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
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add_{{ $data->image_id}}">
                添加图片
            </button>

            <!-- Modal -->
            <div class="modal fade" id="add_{{ $data->image_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <label for="exampleInputFile">请选择你要上传的图片文件</label>
                                    <input type="file" id="exampleInputFile" name="image_file">                              
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">请输入图片名</label>
                                    <?php echo "<br/>"; ?>
                                    <input type="text" class="form-control" name="image_name">                              
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