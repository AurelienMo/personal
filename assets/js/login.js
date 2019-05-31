window.$('body').on('submit', '.ajaxForm', function (e) {
    e.preventDefault();
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
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            if (typeof jqXHR.responseJSON !== 'undefined') {
                if (jqXHR.responseJSON.hasOwnProperty('html')) {
                    $(modal).html(jqXHR.responseJSON.html);
                }
            } else {
                alert(errorThrown);
            }
        })
});
