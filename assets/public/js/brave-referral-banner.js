(function ($) {
  const onReady = function () {
    $('.brb-referral-close').click(function (e) {
      $(this).parent().addClass('brb-hidden');
    });
  };
  $(document).ready(onReady);
})(jQuery);