<div class="panel panel-default">
  <!-- Default panel contents -->

  <div class="panel-body">
      <h2>热门推荐</h2>
 


      
      @foreach($indexData  as $data)
   
      <div class="col-sm-12 article_bar" style="margin-top: 5px;padding: 5px;border: 2px solid #EDEDED;border-radius: 10px"> 
          <div class="col-sm-8" style="padding: 1px">
                <a href="/index_articleDetail/{{$data->article_id}}">
                {{$data->article_title}}
                </a><br><small>{{$data->article_create_date}} | 作者：{{$data->user_nickname}}</small><br>
          <small><?php echo $data->article_intro; ?></small>

            </div>
            <div class="col-sm-4" style="padding: 1px;height:100px">
                <img src="/getImage/{{$data->article_image}}" style="height:100%;width:100%"class="img-rounded">
            </div>
          
      </div>
      @endforeach
      </div> 
</div>