$('#open-bug-report').click(function() {
    $('#bugUrl').val($(location).attr('protocol') + '//www.' + $(location).attr('hostname') + $(location).attr('pathname'));
});

$('#send-bug-report').click(function() {
    $('#bug-report-form').submit();
});