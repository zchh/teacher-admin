$(document).ready(function() {
  //使用unslider
  if($('#slider').unslider) {
    $('#slider').unslider({
      speed: 750,
      delay: 3000,
      dots: true,
      fluid: true
    });
  }
  //使用jquery.placeholder使IE支持placeholder
  if ($('input, textarea').placeholder) {
    $('input, textarea, select').placeholder({ customClass: 'my-placeholder' });
  }

  //去除unslider dots数字
  $('#slider .dots li').html("");
});