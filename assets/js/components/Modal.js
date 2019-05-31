export default class Modal {
    constructor() {
        this.initFull();
    }

    initFull = () =>  {
        window.$('#fullPageModal').on('show.bs.modal', function (event) {
            if (event.relatedTarget != undefined)
            {
                let button = $(event.relatedTarget);
                let url = button.attr('data-href');
                let modal = $(this);
                modal.find('.modal-body').load(url);
            }
        })
    }
}
