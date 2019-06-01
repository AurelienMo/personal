export default class Loader {
    display = () => {
        $('#loader').removeClass('d-none');
    };

    hide = () => {
        $('#loader').addClass('d-none');
    };
}
