//Menu sorting

import dragula from 'dragula/dist/dragula'

let nestedElements = document.querySelectorAll('.nested');
if (nestedElements.length > 0) {
    (function () {
        dragula([].slice.apply(nestedElements), {
            moves: function (el, container, handle) {
                return handle.classList.contains('handle');
            },
        }).on('drop', function (el) {
            if (el.parentNode.parentNode.getAttribute('itemid')) {
                el.querySelector('.parent_id').value = el.parentNode.parentNode.getAttribute('itemid');
            } else {
                el.querySelector('.parent_id').value = 0
            }
            let nestedEl = document.querySelectorAll('.menu-item');

            nestedEl.forEach(item => {
                let indexEl = Array.prototype.indexOf.call(nestedEl, item).toString()
                item.querySelector('.position-item').setAttribute('value', indexEl)
            });

        });
    })();
}
let nestedEl = document.querySelectorAll('.menu-item')
if (nestedEl.length > 0) {
    nestedEl.forEach(item => {
        let indexEl = Array.prototype.indexOf.call(nestedEl, item).toString()
        item.querySelector('.position-item').setAttribute('value', indexEl)
    });
}

let deleteBtns = document.querySelectorAll('.delete-menu-item');
if (deleteBtns.length > 0) {
    deleteBtns.forEach(deleteBtn => {
        deleteBtn.addEventListener('click', (e) => {
            e.preventDefault();
            let idTarget = deleteBtn.getAttribute('data-for');
            let target = document.getElementById('menu-item-' + idTarget);
            target.remove();
        })
    })
}


