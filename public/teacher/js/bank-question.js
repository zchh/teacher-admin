$(document).ready(function() {
  //tab页面切换
  $('.s-question-nav ul').delegate('a', 'click', function(event) {
      // console.log(this);
      event.preventDefault();
      $(this).parent().addClass('active')
      .siblings().removeClass('active');

      $($(this).attr('href')).addClass('active')
      .siblings().removeClass('active');
  });
  //提问弹出框
  $('.btn-ask').on('click', function() {
    $('.modal').show();
    $('.modal-dialog-ask').show();
  });
  //模态框隐藏
  $('.modal').on('click', function() {
    $('.modal').hide();
    $('.modal-dialog-ask').hide();
  })
  $('.btn-confirm').on('click', function() {
    // window.location.href="apply-loan-f2.html";
  });
});
function submitMyAnswerQues(getContentUrl,companyId){
    var answersContent = document.getElementById("answersContent").value;
    if(answersContent == '') {
        alert("请输入你的问题");
        document.getElementById("answersContent").focus();
        return false;
    }
    $.ajax({
        url: getContentUrl,
        type: "post",
        data: {answers_content:answersContent,company_id:companyId},
        cache: false,
        async: false,
        dataType: "json",
        success: function (data) {
            alert('提交成功，等待回复。')
            $('.modal').hide();
            $('.modal-dialog-ask').hide();
        },
        error: function (data) {
            alert('重新提交');
        }
    });
}