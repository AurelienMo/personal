require('assets/scss/home.scss');

$('#avatar').mouseenter(function() {
    $(this).addClass('animated flip');
});

$('#avatar').mouseleave(function() {
    $(this).removeClass('animated flip');
});
