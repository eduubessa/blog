'use strict';

export default () => ({
    tags: {
        words: [],
        elements: {
            input: null
        }
    },
    tag: null,
    initialize: function () {
        this.tags.elements.input = document.querySelector('#tags span:last-child');
        console.log(this.tags.elements.input);
    },
    addTag: function () {
        let new_tag =  `<span class="tag" data-tag="${this.tag}">${this.tag}<i class="fa fa-close"></i></span>`;
    }
});
