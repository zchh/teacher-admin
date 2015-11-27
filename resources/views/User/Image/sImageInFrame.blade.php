@extends("base")
@section("body")
<div class="clo-xs-12">
    <div class="col-xs-4">          
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add_">
            上传新图片
        </button>

    </div>
   
    <div class="col-xs-8">
        @if($nowChoseImageSrc != NULL)
        当前选中的图片   
        <img src="{{$nowChoseImageSrc}}" alt="..."  class="img-rounded img-responsive">

        @endif
    </div>
    <div class="col-xs-12" style="height:30px">
       
    </div>
    
    <hr>
    <div class="col-xs-12">
        @foreach($image as $single)

        <div class="col-xs-4" style="height:300px">
            <div class="thumbnail">
                <img src="/getImage/{{$single -> image_id}}" alt="...">
                <div class="caption">
                    <h5>{{$single -> image_name}}</h5>
                    <p><a type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_{{ $single->image_id}}">
                            删除 </a>
                        <a type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#chose_{{ $single->image_id}}">
                            选择 </a>
                    </p>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="delete_{{ $single->image_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">删除图片</h4>
                    </div>
                    <div class="modal-body">
                        确定要删除吗？               
                    </div>
                    <form>
                        <div class="modal-footer">
                            <a href="/user_dImage/{{$single -> image_id}}" class="btn btn-danger" name="delete">确定删除</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
        
                <!-- Modal -->
        <div class="modal fade" id="chose_{{ $single->image_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">选择文章封面</h4>
                    </div>
                    <div class="modal-body">
                        确定选择{{$single->image_name}}图作为文章封面吗？               
                    </div>
                    <div class="modal-footer">
                        <a href="/user_sImageIdInFrame/{{$single -> image_id}}" class="btn btn-primary">提交</a>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
        
        
    </div>
    <div col-xs-12>
            <?php echo $image->render();?>
        </div>
</div>



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
                        <label for="exampleInputFile">请选择你要上传的图片文件</label>
                        <input type="file" id="exampleInputFile" name="image_file">                              
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">请输入图片名</label>
                        <?php echo "<br/>"; ?>
                        <input type="text" class="form-control" name="image_name">                              
                    </div>
                    <div class="form-group">
                        <label >图片分类</label>
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






@stop

