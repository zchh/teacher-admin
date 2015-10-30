@extends("User.File.base")
@section("main")
<script src="/source/js/lib.js"></script>

<script>
$(document).ready(function(){
    var a = ["t_1","t_2"];
    
    ajax_check(a);
    
});
</script>
<form action="" method="">
            <div class="form-group">
              <label >商品名</label>
              <input type="text" class="form-control" id="t_1" placeholder="">
            </div>
            <div class="form-group">
                <label >详情</label>
                <textarea class="form-control" rows="3" id="t_2"></textarea>
             </div>
            <button type="submit" class="btn btn-default">Submit</button>
 </form>

@stop