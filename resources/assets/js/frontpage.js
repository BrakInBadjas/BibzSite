$('#countdown').countdown('2017/05/15 21:00:00', function(event) {
    $(this).text(event.strftime('%w weeks %d days %H:%M:%S')).fadeIn();
});