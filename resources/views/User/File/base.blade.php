@extends("User.base")

@section("body")
       
        @section("left_nav")
            <div class="col-sm-2 "style="background-color: #F5F5F5;">
                <ul class="nav nav-sidebar">

                  <li class="<?php if(session("nowPage")=="/user_sFile"){echo "active";}?>"><a href="/user_sArticle"  >查看所有文件</a></li>
                  <li class="<?php if(session("nowPage")=="/user_aFile"){echo "active";}?>"><a href="/user_aArticle"  >添加文件桶</a></li>
                </ul>

            </div>
            <style>
             /* Sidebar navigation */
            .nav-sidebar {
              margin-right: -21px; /* 20px padding + 1px border */
              margin-bottom: 20px;
              margin-left: -20px;

            }
            .nav-sidebar > li > a {
              padding-right: 20px;
              padding-left: 20px;
            }
            .nav-sidebar > .active > a,
            .nav-sidebar > .active > a:hover,
            .nav-sidebar > .active > a:focus {
              color: #fff;
              background-color: #428bca;
            }

            </style>
          
        @append

 @append
            



