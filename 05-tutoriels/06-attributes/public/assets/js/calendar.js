jQuery(function ($) {
    // hide all months
    $('.month').hide();

    // show first month
    $('.month:first').show()

    // activate current month
    $('.months-navbar a:first').addClass('color-active')

    var current = 1;

    $('.months-navbar a').click(function () {
          // return the number of month
          var month = $(this).attr('id').replace('month-link-', ''); /* alert(month); return false; */

          if (month !== current) {
              $('#month-'+ current).slideUp();
              $('#month-'+ month).slideDown();
              $('.months-navbar a').removeClass('color-active');
              $('.months-navbar a#month-link-'+ month).addClass('color-active');
              current = month;
          }

          return false;
    });
})