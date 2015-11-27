<div class="panel panel-default">
    <div class="panel-body">
        <h2>版块</h2>
     </div>
    <div class="list-group ">
         <a href="/{{$url}}" class="list-group-item">
              全部分类
         </a>
        
        
        @foreach($classData as $data)
            <a href="/{{$url}}/{{$data -> class_id}}" class="list-group-item article_bar">
              {{$data->class_name}}
            </a>
        @endforeach
        
    </div>
    
</div>

