$(document).ready(function() {
  // 模态框出现
  $('.btn-next').on('click', function() {
    if ($('#checkBoxTypeF').is(':checked') || $('#checkBoxTypeE').is(':checked')) {
      $('.modal').show();
      $('.modal-dialog-deal').show();
    }
  });
  //模态框隐藏

  $('.modal').on('click', function() {
    $('.modal').hide();
    $('.modal-dialog-deal').hide();
  })
  //checkbox
  $('#checkBoxTypeE').on('click', function() {
    var $this = $(this);
    if ($this.is(':checked')) {
      $this.siblings('label').addClass('loan-type-enterprise-checked')
                             .removeClass('loan-type-enterprise');
      $('.s-right label').addClass('loan-type-f')
                         .removeClass('loan-type-f-checked');
      document.getElementById('checkBoxTypeF').checked = false;
    }
    else {
      $this.siblings('label').addClass('loan-type-enterprise')
                             .removeClass('loan-type-enterprise-checked');
    }
  });
  $('#checkBoxTypeF').on('click', function() {
    var $this = $(this);
    if ($this.is(':checked')) {
      $this.siblings('label').addClass('loan-type-f-checked')
                             .removeClass('loan-type-f');
      //选中清除另一边选中状态
      $('.s-left label').addClass('loan-type-enterprise')
                        .removeClass('loan-type-enterprise-checked');
      document.getElementById('checkBoxTypeE').checked = false;
    }
    else {
      $this.siblings('label').addClass('loan-type-f')
                             .removeClass('loan-type-f-checked');
    }
  });
  //select placeholder
  $('select').change(function(event) {
    this.style.color = '#3a3a3a';
  });
});