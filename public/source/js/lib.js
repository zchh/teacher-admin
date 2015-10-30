/*
function ajax_request(id_array, post_url,callback)
{
    
    $.ajax({
            type:"post",
            url:post_url,
            success:callback(data), 
             data:{ 
                 "article_title":$("#a_title").val(),
                 "article_intro":$("#a_intro").val(),
                 "article_class":$("#a_class").val(),
                 "article_sort":$("#a_sort").val(),

                 "article_detail":ue.getContent()
                 }
       });   
    
}


function ajax_check(id_array)
{
    
   
   $.ajax({
        type:"post",
        url:"/check_data",
        success:function(data)
        {
            alert(data);
            if(data.status == true)
            {
                return true
            }
            else
            {
                var a;
                data.returns_data.every(function(item, index, array){
                    if(item =  true)
                    {
                        $("#"+index).addClass();
                    }
                    else
                    {
                        $("#"+index).addClass();
                        $("#"+index).append();
                    }
                    return true;
                    
                });
            }
                
        }
    });
    
}*/