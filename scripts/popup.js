$(document).ready(function () {
    $(".form").submit(function (e) {
        e.preventDefault();
        $('.popup-fade').fadeIn();
    
        $('.popup-close').click(function () {
            $(this).parents('.popup-fade').fadeOut();
            location.reload(true);
            return false;
        });

        $(document).keydown(function (e) {
            if (e.keyCode === 27) {
                e.stopPropagation();
                $('.popup-fade').fadeOut();
            }
        });
 
        $('.popup-fade').click(function (e) {
            if ($(e.target).closest('.popup').length == 0) {
                $(this).fadeOut();
            }
        });
    })
});
