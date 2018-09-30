(function ($) {
  const onReady = function () {
    $('#referral_enabled').change(function (e) {
      $('.configuration').toggleClass('row-hidden');
      $('.preview-container').toggleClass('preview-hidden');
    });

    $('#referral_style').change(function (e) {
      $('.brb-banner')
        .attr('class', 'brb-banner bk-' + $(this).val())
    });

    $('#referral_name').keyup(function (e) {
      const fillValue = $(this).val().length > 0
      ? $(this).val()
      : 'this site';
      $('.preview-container')
        .find('.brb-referral-name')
        .text(fillValue);
    });

    $('#referral_link').keyup(function (e) {
      $('.preview-container')
        .find('.brb-referral-link')
        .attr('href', $(this).val());
    });
  };
  $(document).ready(onReady);
})(jQuery);