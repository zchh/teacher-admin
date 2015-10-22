@extends("User.base")
@section("body")
    
    @include("User.Article.article_nav")

        <div class="col-sm-8">
            <div class="panel panel-default">
                     <div class="panel-body">
                         <h2>添加文章</h2>
                         <hr/>
                         <div class="col-sm-8">
                         
                            <div class="form-group">
                              <label >文章标题</label>
                              <input type="text" id class="form-control" id="article_title" placeholder="文章标题">
                            </div>
                            <div class="form-group">
                              <label >文章简介</label>
                              <input type="text" id class="form-control" id="article_intro" placeholder="文章简介">
                            </div>
                             <div class="form-group">
                                 <label >文章分类</label>
                                <select class="form-control" id="article_class">
                                
                                    @foreach($articleClass as $data)
                                    <option value="{{$data->class_id}}">{{$data->class_name}}</option>
                                   
                                    @endforeach
                                </select>
                             </div>
                             
                            
                                
                            
                        
                         </div>
                         <div class="col-sm-4">
                             <div class="form-group">
                              <label >文章排序</label>
                              <input type="number" id class="form-control" id="article_sort" placeholder="越大越靠前" value="0">
                            </div>
                             <a id="submitForm" class="btn btn-default">提交</a>
                         </div>
                         <div class="col-sm-12 ">
                                <!-- 配置文件 -->
                                <script type="text/javascript" src="/source/ueditor/ueditor.config.js"></script>
                                <!-- 编辑器源码文件 -->
                                <script type="text/javascript" src="/source/ueditor/ueditor.all.js"></script>
                                        
                                <div id="article_detail" type="ue" name="article_detail"  style="height:500px;width:100%;"></div>
                         </div>
                         
                         <script>
                             var ue;
                              $(document).ready(function(){
                                ue = UE.getEditor('article_detail');
                                ue.ready(function() {
                                    ue.setContent("这里填写一些参数表格");
                                    
                                });    
                            
                                });
                                
                         </script>
                         <?php echo $ajaxRequest;?>
                      </div>
            </div>
        </div>
@stop