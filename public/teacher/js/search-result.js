$(document).ready(function() {
  //tab页面切换
  $('.s-search-nav ul').on('click', 'a', function(event) {
      // console.log(this);
      event.preventDefault();
      $(this).parent().addClass('active')
      .siblings().removeClass('active');

      $($(this).attr('href')).addClass('active')
      .siblings().removeClass('active');
  });
  //collapse
  $('.question-control').on('click', 'p', function(event) {
    event.preventDefault();
    if ($(this).find('span').hasClass('icon-up')) {
      $(this).find('span')
             .removeClass('icon-up')
             .addClass('icon-down');
      $(this).siblings('.collapse').hide();
    }
    else {
      $(this).find('span')
             .removeClass('icon-down')
             .addClass('icon-up');
      $(this).siblings('.collapse').show();
      console.log($(this).siblings('.collaspe'));
    }
  })
});