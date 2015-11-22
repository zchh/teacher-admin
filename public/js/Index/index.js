$(document).ready(function(){
    
    //文章类别展示
    $(".article_bar").mousemove(function(){
         
        $(this).css("background-color","#EEEEEE");

        

    });
    $(".article_bar").mouseout(function(){
         $(this).css("background-color","white");
    });
});


