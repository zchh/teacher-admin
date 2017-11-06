$(document).ready(function() {
  //tab页面切换
  $('.info-nav ul').delegate('a', 'click', function(event) {
      // console.log(this);
      event.preventDefault();
      $(this).parent().addClass('active')
      .siblings().removeClass('active');

      $($(this).attr('href')).addClass('active')
      .siblings().removeClass('active');
  });
  $('.btn-update-info').click(function(event) {
    event.preventDefault();
    $('#aMyInfo').parent().addClass('active')
    .siblings().removeClass('active');
    $($(this).attr('href')).addClass('active')
    .siblings().removeClass('active');
  });
  //select placeholder
  $('select').change(function(event) {
    this.style.color = '#3a3a3a';
  });
  //datepicker
  $(function(){
      $('.date').each(function(){
          $(this).ionDatePicker({
              lang: 'zh-cn',
              format: 'YYYY-MM-DD'
          });
      });
  });

});