export default class Header {
    constructor() {
        this.init();
    }

    init = () => {
        $('.first-button').on('click', function () {
            if ($('#navbarSupportedContent22 > ul').children('li').length > 0) {
                $('.animated-icon1').toggleClass('open');
            }
        });
    }
}
