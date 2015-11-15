<div class="col-sm-12 ">

    <div class="col-sm-12">
        <div class="media" style="margin-top: 20px">
            <div class="col-sm-10">
                <div class="media-left">
                    <a href="#">
                        <img style="width: 50px; height: 50px;border-radius:50%" class="media-object" src="{{$reply_data->image_path}}" alt="...">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading ">{{$reply_data->user_username}}<small>【{{$reply_data->reply_create_date}}】</small></h4>
                    {{$reply_data->reply_detail}}
                </div>
            </div>
            <div class="col-sm-2">
                <div class="media-right">
                    <a href="#tips">
                        <button reply_id="{{$reply_data->reply_id}}" user_username="{{$reply_data->user_username}}" class="add_reply_modal_run btn btn-default pull-right btn-xs">评论</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="col-sm-12"></div>
    <div class="col-sm-12"></div>
    <div class="col-sm-12"></div>
    <div class="col-sm-12"></div>
    <div class="col-sm-12"></div>
    <div class="col-sm-12"></div>
    <div class="col-sm-12"></div>
    <div class="col-sm-12"></div>
    <div class="col-sm-12"></div>
    <div class="col-sm-12"></div>
    <div class="col-sm-12"></div>
    <?php echo $son ?>
</div>




