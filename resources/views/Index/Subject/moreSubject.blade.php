@extends("Index.base")

@section("main")
 <div class="col-sm-8 col-sm-offset-1">
      <div class="panel panel-default">
            <div class="panel-body">
                <h2>{{$subjectData->subject_name}} <small> {{$subjectData->subject_create_date}}</small></h2>
                <hr>
                {{$subjectData->subject_intro}}
                <hr>
                @foreach($articleData as $data)
                <h4><a href="/index_articleDetail/{{$data->article_id}}" >{{$data->article_title}}</a> <small> {{$data->article_create_date}}</small>
                    </h4>
                @endforeach
             </div>
       </div>
</div>
<div class="col-sm-2">
    <?php echo $userInfoGui; ?>
</div>

 

@stop

