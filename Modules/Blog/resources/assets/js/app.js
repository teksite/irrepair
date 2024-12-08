import dragula from 'dragula/dist/dragula'

let nestedElements = document.querySelector('.nested');
if (nestedElements) {
    (function () {
        dragula([nestedElements], {
            moves: function (el, container, handle) {
                return handle.classList.contains('handle');
            },
        }).on('drop', function (el) {
                let nestedEl = document.querySelectorAll('.item_id');
            nestedEl.forEach(item => {
                item.value=Array.prototype.indexOf.call(nestedEl, item).toString();
            });

        });
    })();
}

