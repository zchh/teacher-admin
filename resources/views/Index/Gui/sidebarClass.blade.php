<div class="panel panel-default">
    
    <div class="list-group">
        @foreach($classData as $data)
            <a href="/index_sDisplayArticleClass/{{$data -> class_id}}" class="list-group-item">
              {{$data->class_name}}
            </a>
        @endforeach
        
    </div>
    <div class="panel-body">
     </div>
</div>

