@extends("Admin.base")
@section("left_nav")

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2 ">


            <ul class="nav nav-sidebar nav-pills nav-stacked">
                <li class="<?php if(session("now_address") == "/admin_sAdmin"){echo "active";}  ?>"><a href="/admin_sAdmin">查看管理员</a></li>
                <li class="<?php if(session("now_address") == "/admin_sAdminPowerGroup"){echo "active";}  ?>"><a href="/admin_sAdminPowerGroup">查看权限组</a></li>


            </ul>
        </div>

@append
