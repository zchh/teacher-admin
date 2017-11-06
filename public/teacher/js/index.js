$(document).ready(function() {
  //展示li中中间li两边的边距
  function cssProvide() {
    for ( var i = 0, len = $('.s-produce .produce-list li').length; i < len ; i++) {
      if ( i % 3 === 1) {
        $($('.s-produce .produce-list li')[i]).addClass('h-plr20');
      }
    }
    for ( var i = 0, len = $('.s-service li').length; i < len; i++) {
      if( i %3 === 1) {
        $($('.s-service .service-list li')[i]).addClass('h-plr105')
      }
    }

  }
  cssProvide();
});