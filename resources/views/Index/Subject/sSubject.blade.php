@extends("Index.base")

@section("main")

    <div class="col-sm-7 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-hover">
                    @foreach($subject as $single)
                        <tr>
                            <td>
                                <a href="/index_moreSubject/{{$single->class_id}}">
                                    {{$single -> class_name}}
                                </a><small> {{$single -> recommend_update_date}}</small>
                            </td>

                        </tr>             
                    @endforeach
                </table>
               <?php echo $subject->render(); ?>  
            </div>
        </div>

    </div>


@stop
