$('#duplicate_btn').click(function (e) {
    e.preventDefault();
    var $clone = $('#duplicate').clone().attr('id', '').removeClass('hidden');
    $('#duplicate').before($clone);
});