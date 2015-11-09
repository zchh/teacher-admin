@extends("Index.base")

@section("main")

 <div class="col-sm-9" >
     <div class="panel panel-default">
         <div class="panel-body" style="background-color: gray">
           @foreach($subject as $single)
             <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3 class="panel-title">{{$single->subject_name}}</h3>
                        </div>
                        <div class="panel-body">
                         {{$single->subject_intro}}
                         <hr/>
                         <a href="/index_moreSubject/{{$single->subject_id}}" class="btn btn-default">查看详情</a>
                        </div>
                    </div>
             </div>
           @endforeach

@stop

