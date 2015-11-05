@extends("Index.base")

@section("main")
  <div class="col-sm-12">
     <div class="panel panel-default">
         <div class="panel-body">
                     不知道干嘛
          </div>
    </div>
  </div>
  <div class="col-sm-9" >
    
             @foreach($articleData as $data)
             <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3 class="panel-title">{{$data->article_title}}</h3>
                        </div>
                        <div class="panel-body">
                         {{$data->article_intro}}
                         <hr/>
                         <a href="" class="btn btn-default">查看详情</a>
                        </div>
                    </div>
             </div>
             
             @endforeach

     
  </div>
  <div class="col-sm-3">
     <div class="panel panel-default">
         <div class="panel-body"> 
             <br/>
              这低下应该是热门推荐  ，在后台设置<br>
              <a href="/index_findArticle">查找文章</a><br>
              <a href="/index_articleDetail">文章细节</a><br>
              <a href="/index_sArticle">查看一堆文章</a><br>
              <a href="/index_userIndex">用户首页</a><br>
              <a href="/index_sSubject">查看一堆专题</a><br>
              <a href="/index_moreSubject">查看一个专题的详情</a><br>
              <hr/>
              
          </div>
    </div>
  </div>
@stop
