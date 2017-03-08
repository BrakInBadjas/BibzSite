$(function() {
    $('#button-approve').click(function() {
        $('#validation_status').val('approved');
        $('#post-validation').submit();
    });

    $('#button-null').click(function() {
        $('#validation_status').val('null');
        $('#post-validation').submit();
    });

    $('#button-deny').click(function() {
        $('#validation_status').val('denied');
        $('#post-validation').submit();
    });

    $('[action="vote"]').click(function() {
        var vote = $(this).attr('vote');
        var id = $(this).attr('adtje-id');

        var form = $('#post-validation');
        form.attr('action', form.attr('action').replace(/ADTJEID/g, id));
        $('#validation_status').attr('value', vote);
        form.submit();
    })
});