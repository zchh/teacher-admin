@extends("User.base")

@section("body")
       
        @section("left_nav")
            <div class="col-sm-2 ">
                <ul class="nav nav-sidebar nav-pills nav-stacked">

                  <li class="<?php if(session("nowPage")=="/user_sImage"){echo "active";}?>"><a href="/user_sImage"  id="user_sArticle">查看所有图片</a></li>
                  

                </ul>
                

            </div>
            
          
        @append

 @append
            



