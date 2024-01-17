(function ($) {
   $('.add-to-cart').click(function (event) {

       event.preventDefault();

       $.get($(this).attr('href'), {}, function (data) {
           /* console.log(data) */
           if (data.error) {
               alert(data.message)
           } else {
               if(confirm(data.message + '. Voulez vous consulter votre panier ?')) {
                   location.href = '/cart';
               } else {
                   $('#total').empty().append(data.total);
                   $('#count').empty().append(data.count);
               }
           }
       }, 'json')

       return false;
   });
})(jQuery);