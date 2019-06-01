import Loader from "./components/Loader";

let $loader = new Loader();
window.$('body').on('submit', '.ajaxForm', function (e) {
    e.preventDefault();
    $loader.display();
    let modal = $('.modal-body');
    $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize()
    })
        .done(function (data) {
            if (typeof data.message !== 'undefined') {
                modal.html(data.html);
            }
            $loader.hide();
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            if (typeof jqXHR.responseJSON !== 'undefined') {
                if (jqXHR.responseJSON.hasOwnProperty('html')) {
                    $(modal).html(jqXHR.responseJSON.html);
                }
            } else {
                alert(errorThrown);
            }
            $loader.hide();
        })
});
