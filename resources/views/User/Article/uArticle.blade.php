@extends("User.Article.base")
@section("main")
  
        <div class="col-sm-8">
             <div class="panel panel-default">
             <div class="panel-body">
          
                 <div class="col-sm-6 form-group">
                     <label >文章名</label>
                     <input type="text" class="form-control" placeholder="" id="a_title" value="{{$articleDetail->article_title}}">
                 </div>
                  <div class="col-sm-6 form-group">
                     <label >文章分类</label>
                     <select class="form-control" id="a_class" value="{{$articleDetail->article_class}}">
                                
                                    @foreach($articleClass as $data)
                                    <option value="{{$data->class_id}}">{{$data->class_name}}</option>
                                   
                                    @endforeach
                    </select>
                 </div>
                  <div class="col-sm-6 form-group">
                     <label >文章简介</label>
                     <input type="text" class="form-control" placeholder="" id="a_intro" value="{{$articleDetail->article_intro}}">
                   
                 </div>
                  <div class="col-sm-6 form-group">
                     <label >文章排序</label>
                     <input type="text" class="form-control" placeholder="" id="a_sort" value="{{$articleDetail->article_sort}}">
                   
                 </div>

                <div class="col-sm-12 form-group" >
                  <a id="submit" class="btn btn-default">提交</a>  
               </div>

                 <div class="col-sm-12">

                    <script type="text/javascript" src="/source/ueditor/ueditor.config.js"></script>
                    <!-- 编辑器源码文件 -->
                    <script type="text/javascript" src="/source/ueditor/ueditor.all.js"></script>

                    <script id="article_detail" type="text/plain" style="height:500px;width:100%;"></script>

                </div>

                                
                            
                        
             </div>   
              </div>
        </div>



    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" id="show_message" data-toggle="modal" data-target="#show_message_modal">
      
    </button>

    <!-- Modal -->
    <div class="modal fade" id="show_message_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">修改结果</h4>
          </div>
          <div class="modal-body">
                <div class="" id="return_message" role="alertreturn_data" >返回信息</div>
          </div>
          <div class="modal-footer">
            
            
          </div>
        </div>
      </div>
    </div>
   

<script>
 $(document).ready(function(){
     $('#show_message').hide();
    var ue = UE.getEditor('article_detail');
    ue.ready(function() {
     
      $.ajax({
            type:"post",
            url:"/user_ajax_getNowArticleDetail",
            success:function(data){
                ue.execCommand("source");
                ue.setContent(data);
                ue.execCommand("source");
             }, 
             data:{ "article_id":"{{$articleDetail->article_id}}"}
              }); 
       

    });    
      $("#submit").click(function(){
        //alert($("#a_title").val());
        //alert("a");
        $.ajax({
         type:"post",
         url:"/_user_uArticle",
         success:function(data){
           
           //$("#inst").html(data);
            $('#show_message').trigger('click');  //模拟点开模态框
           if(data.status==true)
           {
               //$("#return_message").addClass("alert-success");
               $("#return_message").html(data.message);
               setTimeout('window.location = "/user_sArticle";', 1000);
           }
           else
           {
               //$("#return_message").addClass("alert-danger");
               $("#return_message").html(data.message);
           }
           
          }, 
          data:{ 
              "article_title":$("#a_title").val(),
              "article_intro":$("#a_intro").val(),
              "article_class":$("#a_class").val(),
              "article_sort":$("#a_sort").val(),
              "article_id":{{$articleDetail->article_id}},
              "article_detail":ue.getContent()
              }
          });  
        
    });
     
    });   
    
   
    
    
        

    
    </script>             
                     
@stop
   