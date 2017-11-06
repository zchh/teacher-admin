$(document).ready(function() {
  // 模态框出现
  //$('.btn-next').on('click', function() {
  //  $('.modal').show();
  //  $('.modal-dialog-success').show();
  //});
  //模态框隐藏

  $('.modal').on('click', function() {
    $('.modal').hide();
    $('.modal-dialog-success').hide();
  })
  //权证取得情况中checkbox选中显示ul

  $('.right-info').on('change', '#proRight, #woodsRight', function() {
    if ($(this).is(':checked')) {
      $(this).siblings('.ul-pop').show()
    }
    else {
      $(this).siblings('.ul-pop').hide()
    }
  });
  //ul选中
  $('.ul-pop').on('click', 'li', function(){
    var $this = $(this);
      var liName = $this.text();
      if ($this.hasClass('active')) {
      $this.removeClass('active');
          $this.removeAttr("name");
    }
    else {
      $this.addClass('active');
          $this.attr("name",liName);
    }
  })
  //pop
  $('.form-control').on('change', '#houseRight, #landRight, #treeRight, #surfaceRight, #collRight, #others', function(e) {
    // console.log(this);
    if ($(this).is(':checked')) {
      $(this).siblings('.pop').show();
    }
    else {
      $(this).siblings('.pop').hide();
    }
  })
  //select placeholder
  $('select').change(function(event) {
    this.style.color = '#3a3a3a';
  });
});

function setPropertyRightsData(checkId,inputId,textContent){
    if(document.getElementById(checkId).checked){
        document.getElementById(inputId).value = textContent;
    }
}

function setCertificateOne(checkId, ulId, nameStrId, nameStrDesc, value){
    if(document.getElementById(checkId).checked){
        var descStr = '';
        var oItem = document.getElementById(ulId).getElementsByTagName("li");
        for(var i =0; i< oItem.length; i++){
            var liLable = oItem[i];
            if(liLable.className == "active"){
                descStr += liLable.innerHTML+',';
            }
        }
        var reg=/,$/gi;
        if(descStr != ''){
            descStr = descStr.replace(reg,"");
        }
        document.getElementById(nameStrId).value = value;
        document.getElementById(nameStrDesc).value = descStr;
    }

}