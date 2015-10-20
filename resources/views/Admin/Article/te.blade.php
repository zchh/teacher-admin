@extends("Admin.base")
@section("main")
     
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

               <div class="form-group">
                       <label>留言人</label>
                       <input type="text" class="form-control" id="admin_username" placeholder="管理员用户名">
               </div>
               <div class="form-group">
                       <label>详情</label>
                       <input type="password" class="form-control" id="admin_password" placeholder="管理员密码">
               </div>

               <button type="submit" class="btn btn-default" id="123">提交</button>
       
<?php echo $ajax_request?>
@stop