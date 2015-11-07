@extends("Index.base")

@section("main")
    <div class="col-sm-10 col-sm-offset-1">
        <div class="col-sm-12">
           
            
            <div class="col-sm-12" >
                <div class="panel panel-default">
                     <div class="panel-body" style="height:200px">
                             Basic panel example
                      </div>
                </div>
                
            </div>
        </div>
        <div class="col-sm-9">
           <div class="col-sm-6">
          <?php echo $displayArticleGui; ?>
           </div>
           <div class="col-sm-6">
            <?php echo $newArticle;?>
           </div>
           
        </div>
       
       
    
    </div>

@stop
