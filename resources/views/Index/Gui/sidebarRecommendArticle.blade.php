<div class="panel panel-default">
     <div class="panel-body">
         <h2>热门推荐</h2>
     </div>  
    <div class="list-group ">
        @foreach($displayData as $data)
            <a href="/index_articleDetail/{{$data->display_article_id}}" class="list-group-item article_bar">
              {{$data->article_title}}
            </a>
        @endforeach
        
    </div>
 
</div>

