@extends("Index.base")

@section("main")
    
    <div class="col-sm-10 col-sm-offset-1">
      
     
         
           
           <div class="col-sm-5">
                <?php echo $indexRecommendArticle;?>
           </div>
            <div class="col-sm-5">
                <?php echo $newArticle;?>
           </div>
            <div class="col-sm-2"> <?php echo $displaySidebarClass;?></div>
            <?php
            /*
            <div class="col-sm-12" style="padding: 0px">
                <div class="col-sm-6">
                      <?php echo $displayArticleClassGui1; ?>
                 </div>
                  <div class="col-sm-6">
                      <?php echo $displayArticleClassGui2; ?>
                 </div>
            </div>
              
            <div class="col-sm-12" style="padding: 0px">
                
                 <div class="col-sm-6">
                     <?php echo $displayArticleClassGui3; ?>
                </div>
            </div>*/
            ?>
           
    

    
            

        
       
    
    </div>
    <link rel="stylesheet" href="/css/Index/index.css"/>
@stop

