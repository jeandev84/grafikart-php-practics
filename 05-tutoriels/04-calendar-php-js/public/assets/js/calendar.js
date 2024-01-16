jQuery(function ($) {
    // hide all months
    $('.month').hide();

    // show first month
    $('.month:first').show()

    // activate current month
    $('.months-navbar a:first').addClass('color-active')

    var current = 1;

    $('.months-navbar a').click(function () {
          var month = $(this).attr('id').replace('month-link-', '');
          alert(month);
          return false;
    });
})