@if($status == true)
<div>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3>成功</h3>
        <p>{{$message}}</p>
        <p><?php echo $plugin ?></p>
    </div>
</div>
@else 
<div >
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3>失败</h3>
            {{$message}}
        <p><?php echo $plugin ?></p>
    </div>
</div>
@endif