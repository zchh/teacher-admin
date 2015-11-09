@extends("Index.base")

@section("main")
    <div class="col-sm-7 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-hover">
                    @foreach($articleData as $data)
                        <tr>
                            <td>
                                <a href="/index_articleDetail/{{$data->article_id}}">
                                    {{$data->article_title}}
                                </a><small>{{$data->article_create_date}}</small>
                            </td>


                        </tr>
                    @endforeach
                </table>
                <?php $articleData->render();?>
            </div>
        </div>

    </div>

    <div class="col-sm-3">
        <?php echo $articleClassBar;?>
    </div>
    <div class="col-sm-3">
        <?php echo $indexRecommendArticle;?>
    </div>
@stop