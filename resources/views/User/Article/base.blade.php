
@extends("User.base")

@section("body")
       
        @section("left_nav")
            <div class="col-sm-2 "style="background-color: #F5F5F5;">
                <ul class="nav nav-sidebar nav-pills nav-stacked">

                  <li class="<?php if(session("nowPage")=="/user_sArticle"){echo "active";}?>"><a href="/user_sArticle"  id="user_sArticle">查看文章</a></li>
                  <li class="<?php if(session("nowPage")=="/user_aArticle"){echo "active";}?>"><a href="/user_aArticle"  id="user_aArticle">添加文章</a></li>
                  <li class="<?php if(session("nowPage")=="/user_sCollect"){echo "active";}?>"><a href="/user_sCollect"  id="user_sCollect">收藏文章</a></li>

                </ul>
                <ul class="nav nav-sidebar">
                  <li class="<?php if(session("nowPage")=="/user_sSubject"){echo "active";}?>"><a href="/user_sSubject">查看专题</a></li>
                   <li class="<?php if(session("nowPage")=="/user_sClass"){echo "active";}?>"><a href="/user_sClass"  >查看类别</a></li>
                 <?php //<li class=" if(session("nowPage")=="/user_sLabel"){echo "active";}"><a href="/user_sLabel">查看标签</a></li> ?>
                  <li class="<?php if(session("nowPage")=="/user_sReply"){echo "active";}?>"><a href="/user_sReply">查看评论</a></li>
                  <?php //<li class="php if(session("nowPage")=="/user_readAllArticle"){echo "active";}"><a href="/user_readAllArticle" id="user_readAllArticle">查看其他用户文章</a></li>?>
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
            




