@extends("Admin.base")
@section("left_nav")

        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-pills nav-stacked">
                <li class="<?php if(session("now_address") == "/admin_sUser"){echo "active";}?>"><a href="/admin_sUser">查看所有用户</a></li>
                <li class="<?php if(session("now_address") == "/admin_sUserPowerGroup"){echo "active";}?>"><a href="/admin_sUserPowerGroup">查看权限组</a></li>
            </ul>
        </div>

@append