$(document).ready(function() {
    $(".btn-delete").click(function(e) {
        var currentElement = $(this);
        e.preventDefault();
        alertify.confirm('Xác Nhận Xóa', 'Bạn có chắc muốn xóa?', function() {
            // console.log(currentElement.attr('href'));
            url = currentElement.attr('href');
            window.location = url;
            // alertify.success('Ok')
        }, function() {
            // alertify.error('Cancel')
        });
    });
});
