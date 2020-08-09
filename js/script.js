// Or with jQuery

$(document).ready(function () {
  $('.modal').modal();
  $('.modal-mb').modal();
  $('.modal-del').modal();

  $('.dropdown-trigger').dropdown();
});

// パスワード表示
$(function () {
  var $icon = $('.material-icons');

  $('.password-toggler').click(function () {
    if ($(this).children($icon).text() == 'visibility') {
      $(this).children($icon).text('visibility_off');
      $(this).prev('input').attr('type', 'text');
    } else {
      $(this).children($icon).text('visibility');
      $(this).prev('input').attr('type', 'password');
    }
  });
});
