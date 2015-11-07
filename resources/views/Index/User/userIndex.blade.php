@extends("Index.base")
@section("main")

<div class="col-sm-8 col-sm-offset-2">
	<div class="panel panel-default">
         <div class="panel-body">
             <div class="col-sm-12" style="background:url('/Public/2h.jpg');
		background-size:100% 100%;height:300px;border: 1px solid gray;
		border-radius:10px;	">
                 <div style="margin: 15px auto; width:150px;height:150px">
                      <img src="/Public/folder.jpg" class="img-circle" style="margin:auto ;width:100%;height:100%">
                 </div>
                 <div style="width:150px;height:100px;margin:15px auto;" >
                     <h3 style="text-align: center;color:white">{{$userData->user_username}}</h3>
                     <a  class="btn btn-default btn-sm" href="#" aria-label="Left Align" style="margin: auto;display: block">
                      <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>  关注
                     </a>
                 </div>
                
             </div>
             <div class="col-sm-12" class="col-sm-12" style="height:10px"></div>
             <div class="col-sm-12">
              
                                <div>
                                     <!-- Nav tabs -->
                                    <ul class="nav nav-tabs " role="tablist">
                                        <li role="presentation" class="active"><a href="#article" aria-controls="article" role="tab" data-toggle="tab">
                                                  <h3><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 文章</h3>
                                            </a></li>
                                      <li role="presentation"><a href="#subject" aria-controls="subject" role="tab" data-toggle="tab">
                                              <h3><span class="glyphicon glyphicon-book" aria-hidden="true"></span> 专题</h3></a></li>
                                      <li role="presentation"><a href="#image" aria-controls="image" role="tab" data-toggle="tab">
                                              <h3><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> 图片</h3></a></li>
                                     
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="article" class="tab-pane active " id="article">
                                              @foreach($articleData as $data)
                                                
                                                       <div class="panel panel-default">
                                                           <div class="panel-body">
                                                               <div class="col-sm-8">
                                                                   <h4>{{$data->article_title}} </h4><small> | {{$data->article_create_date}}.</small><br>
                                                                   {{$data->article_intro}}
                                                               </div>
                                                               <div class="col-sm-4">
                                                                   <img src="/Public/2h.jpg" class="img-responsive img-rounded">

                                                               </div>
                                                               <div class="col-sm-12">
                                                               <a href="/index_articleDetail/{{$data->article_id}}" class="btn btn-default  ">查看详情</a>
                                                               </div>


                                                           </div>
                                                       </div>
                                               



                                              @endforeach
                                            
                                            
                                        </div>
                                        <div role="subject" class="tab-pane fade " id="subject">
                                             @foreach($subjectData as $data)
                                                
                                                       <div class="panel panel-default">
                                                           <div class="panel-body">
                                                               <div class="col-sm-8">
                                                                   <h4>{{$data->subject_name}} </h4><small> | {{$data->subject_create_date}}.</small><br>
                                                                   {{$data->subject_intro}}
                                                               </div>
                                                               <div class="col-sm-4">
                                                                   <img src="/Public/2h.jpg" class="img-responsive img-rounded">

                                                               </div>
                                                               <div class="col-sm-12">
                                                               <a href="/index_moreSubject/{{$data->subject_id}}" class="btn btn-default  ">查看详情</a>
                                                               </div>

                                                           </div>
                                                       </div>
                                               


                                              @endforeach
                                        </div>
                                        <div role="image" class="tab-pane  fade" id="image">
                                            sadaddasdasd
                                        </div>
                                     
                                    </div>

                                  </div>
            </div>
              
          </div>
    </div>
</div>





