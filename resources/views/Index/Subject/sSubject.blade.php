@extends("Index.base")

@section("main")

    <div class="col-sm-7 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-body">
                <h2>{{$class_name}}</h2>
                <table class="table table-hover">
                    @foreach($subject as $single)
                        <tr>
                            <td>
                                <h4><a href="/index_moreSubject/{{$single->recommend_subject}}">
                                    {{$single->subject_name}}
                                    </a><small> {{$single -> recommend_update_date}} | 作者：{{$single -> user_nickname}}</small></h4>
                            </td>

                        </tr>             
                    @endforeach
                </table>
               <?php echo $subject->render(); ?>  
            </div>
        </div>

    </div>
    <div class="col-sm-2">
       <?php echo $siderGui;?>
    </div>


@stop
