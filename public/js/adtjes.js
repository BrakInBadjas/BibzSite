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
});
//# sourceMappingURL=adtjes.js.map
