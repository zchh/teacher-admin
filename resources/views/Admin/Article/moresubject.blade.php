@extends("Admin.Article.base")
@section("main")
<script type="text/javascript">
    $(function() {
        /*$("#CheckedAllArticle").toggle(
         function () {
         $("[name='article_id_array[]']").prop("checked",true);
         },
         function () {
         $("[name='article_id_array[]']").prop("checked",false);
         }
         ); */
        var i = 0;
        $("#CheckedAllArticle").click(function() {
            if (i == 0)
            {
                //alert("ok");
                $("[name='article_id_array[]']").prop("checked", true);
                i = 1;
            }
            else
            {
                $("[name='article_id_array[]']").prop("checked", false);
                i = 0;
            }
        });
    });
</script>

<!-- Modal文章添加 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">文章添加</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/admin_AddArticleToSubject2" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="subject_id" value="{{$subject_by_id->subject_id}}">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">选择文章</label>
                        <div class="col-sm-10">
                            <button type="button" id="CheckedAllArticle" class="btn btn-primary btn-xs">全选/全不选</button>
                            @foreach($all_article_data as $all_article)
                            @if(!in_array($all_article->article_id,$article_ids))
                            <h4><input type="checkbox" name="article_id_array[]"  value="{{$all_article->article_id}}" > {{$all_article->article_id}} : {{$all_article->article_title}}</input></h4>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-default">添加</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="col-sm-5">
    <h2>当前专题：{{$subject_by_id->subject_name}} | <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            添加文章
        </button></h2>
    <hr>
</div>

<div class="col-sm-8">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>文章创建日期</th>
                <th>文章修改日期</th>
                <th>主题</th>
                <th>操作</th>
            </tr>
        </thead>
        @foreach($article_by_subject as $data)
        <tbody>
            <tr>
                <td>{{ $data->article_id }}</td>
                <td>{{ $data->article_create_date }}</td>
                <td>{{ $data->article_update_date }}</td>
                <td>{{ $data->article_title }}</td>
                @if($article_by_subject[0]->article_id != null)
                <td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$data->article_id}}">
                        移除
                    </button>
                </td>
                <!-- Modal文章删除 -->
        <div class="modal fade" id="delete{{$data->article_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">警告！</h4>
                    </div>
                    <div class="modal-body">
                       你确定从当前专题要移除此文章吗？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <a class="btn btn-danger btn-sm" href="/admin_RemoveArticleToSubject/{{ $data->subject_id }}/{{ $data->article_id }}" class="btn btn-danger">[移除该文章]</a>
                    </div>
                </div>
            </div>
        </div>
        @else
        <td></td>
        @endif
        </tr>
        </tbody>
        @endforeach
    </table>
</div>

@stop