<div class="col-sm-12">

    <form action="/user_aReply" method="post">
        <input type="hidden" name="reply_parent" id="reply_parent" value="" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="reply_article" value="{{$article_id}}">
        <div class="form-group">
            <label >详情</label>
            <a id="tips">
                <textarea class="form-control" name="reply_detail" id="reply_detail"  rows="5" placeholder="回复文章"></textarea>
            </a>
        </div>
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        $(".add_reply_modal_run").click(function() {
            var $id = $(this).attr("reply_id");
            var $user_username =$(this).attr("user_username");
            $("#reply_parent").val($id);
            $("#reply_detail").attr("placeholder", "回复" + $user_username);
        });
    });
</script>


