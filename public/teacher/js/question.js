$(document).ready(function() {
  //tab页面切换

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
      // console.log($(this).siblings('.collaspe'));
    }
  })
});