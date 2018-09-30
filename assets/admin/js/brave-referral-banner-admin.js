(function ($) {
  const onReady = function () {
    $('#referral_enabled').change(function (e) {
      $('.configuration').toggleClass('row-hidden');
    });

    $('#referral_style').change(function (e) {
      $('.style-color')
        .attr('class', 'style-color bk-' + $(this).val())
    });
  };
  $(document).ready(onReady);
})(jQuery);