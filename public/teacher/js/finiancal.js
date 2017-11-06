$(document).ready(function() {
  //sub-sel a确认事件
  $('.container').on('click', '.sub-sel a', function(e) {
    e.preventDefault();
    var $this = $(this);
    $this.parent().addClass('active').siblings().removeClass('active');
    $this.parent().parent().siblings('a').html($this.html());
    $this.parent().parent().removeClass('on');
  });
  //弹出sub-sel
  $('.container').on('click', '.toggle', function(e) {
    // console.log('pop');
    e.preventDefault();
    e.stopPropagation();
    $(this).siblings('.sub-sel').addClass('on');
  });
  // // 隐藏sub-sel
  $('body').on('click', function(e) {
    // console.log('close');
    $('.sub-sel').removeClass('on');
  });
});