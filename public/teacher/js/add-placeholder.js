$(document).ready(function() {
  //加载jquery.placeholder使IE支持placeholder
  if ($('input, textarea').placeholder) {
    $('input, textarea').placeholder({ customClass: 'my-placeholder' });
  }
});