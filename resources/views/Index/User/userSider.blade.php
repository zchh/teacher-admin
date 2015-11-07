  <div class="panel panel-default">
            <div class="panel-body">
                    <img src="/Public/2h.jpg" class="text-center img-circle img-responsive" style="width:80%;height:100%;left: 10%;position:relative">
                    <hr/>
                    <h4 style='margin: auto'>{{$userData->user_username}}</h4>
                    <hr>
                    <small>{{$userData->user_intro}}</small>
                    <hr>
                    <a  class="btn btn-default btn-sm" href="/index_userIndex/{{$userData->user_id}}" aria-label="Left Align">
                      <span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span>  个人主页
                    </a>
                     <a  class="btn btn-default btn-sm" href="#" aria-label="Left Align">
                      <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>  关注
                    </a>
             </div>
       </div>