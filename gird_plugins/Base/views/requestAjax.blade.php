
<button type="button" id="__Ajax_BaseFunc_click" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#__Ajax_BaseFunc_recv">

</button>

<div class="modal fade" id="__Ajax_BaseFunc_recv" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title " id="__recv_title"></h4>
      </div>
      <div class="modal-body">
          <div id="__recv_message"></div>
      </div>
      <div class="modal-footer">
       
        <div id="__recv_plugin"></div>
        
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
    $("#__Ajax_BaseFunc_click").hide();
    $("#{{$submit_id}}").click(function(){
        var send_data ={};
        var tmp;
        @foreach($data_id_array as $data)
              tmp = $("#{{$data}}").attr("type");
              if(tmp == "radio")
              {
                  //对于单选框，只需要输入首行id,值提取value中的
                  tmp = $("#{{$data}}").attr("name");
                  send_data[tmp] = $("input[name='"+tmp+"']:checked").val();
                  //alert(send_data[tmp]);
              }
              else if(tmp == "checkbox")
              {
                  //对于复选框，需要输入首行id,键名以名字为准
                  tmp = $("#{{$data}}").attr("name");
                  var $a = $("input[name='"+tmp+"']:checked")
                  //alert($a);
                  var checkbox_array = new Array;
                    $a.each(function(){
                            checkbox_array.push($(this).val());
                    });
                    send_data[tmp] = checkbox_array;
              }
              else
              {
                  //一般的text password 直接使用value
                  send_data["{{$data}}"] = $("#{{$data}}").val();
                  
              }
              
        @endforeach
        //writeObj(send_data);
        $.ajax({
                type:"post",
                url:"{{$recv}}",

                //async:false,
                success:function(data){
                     
                      var debug = {{$debug==true ? 1 : 0}};
                      if(debug != 1)
                      {
                            $("#__recv_title").html(data.title);
                            $("#__recv_message").html(data.message);
                            $("#__recv_plugin").html(data.plugin);
                      }
                      else
                      {
                          $("#__recv_message").html(data);
                      }
                      
                      $("#__Ajax_BaseFunc_click").trigger("click");
                      
                    /*$("#__recv_message").html(data);
                      //writeObj(data);
                      $("#__Ajax_BaseFunc_click").trigger("click");*/
                 }, 
                 data:send_data
             });

    });
}); 
    function writeObj(obj){ 
        var description = ""; 
        for(var i in obj){   
            var property=obj[i];   
            description+=i+" = "+property+"\n";  
        }   
        alert(description); 
    } 
</script>

            
