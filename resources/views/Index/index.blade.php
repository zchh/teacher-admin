@extends("Index.base")

@section("main")
    <div class="col-sm-10 col-sm-offset-1">
        <div class="col-sm-12">
           
            
            
                <div class="panel panel-default">
                     <div class="panel-body" style="height:200px">
                             Basic panel example
                      </div>
                </div>
                
           
        </div>
        <div class="col-sm-9">
         
           
           <div class="col-sm-6">
                <?php echo $indexRecommendArticle;?>
           </div>
            <div class="col-sm-6">
                <?php echo $newArticle;?>
           </div>
          <div class="col-sm-6">
                <?php echo $displayArticleGui; ?>
           </div>
           
        </div>
        <div class="col-sm-3">
            <?php echo $displaySidebarClass;?>
        </div>
       
       
    
    </div>

@stop
