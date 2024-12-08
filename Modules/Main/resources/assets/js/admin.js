import './bootstrap.js';
import iconSetter, {iconList} from "./icon.js";
import TomSelect from "tom-select";
import 'tom-select/dist/css/tom-select.css';
import Swal from "sweetalert2";
import trans from "./lang.js"
import {debounce} from "./utilities.js";


//     Slug maker and Changer     //
function ChangeToSlug(string, separator) {
    let delimter = separator || '-';
    let slug;

    slug = string;
    slug = slug.replace(/[A-Z]/gi, word => {
        let upperCaseWord = word.toUpperCase();
        if (upperCaseWord === word) {
            return '-' + word.toLowerCase()
        } else {
            return word;
        }
    });
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');

    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|'|\"|\:|\;/gi, '');
    slug = slug.replace(/ /gi, delimter);

    slug = slug.replace(/\-\-\-\-\-/gi, delimter);
    slug = slug.replace(/\-\-\-\-/gi, delimter);
    slug = slug.replace(/\-\-\-/gi, delimter);
    slug = slug.replace(/\-\-/gi, delimter);
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    return slug;
}

//     Change slug in editor     //
let slugEl = document.querySelectorAll('input[name = "slug"]');
if (slugEl.length > 0) {
    slugEl.forEach(item => {
        item.addEventListener('focusout', () => {
            item.value = ChangeToSlug(item.value);
        })
    });
}


const deleteItemButtons = document.querySelectorAll('.delete-item-btn');
if (deleteItemButtons.length) {
    deleteItemButtons.forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            let targetId = btn.getAttribute('data-target')
            let target = document.getElementById(targetId);
            let targetWrapper = target?.closest('tr') ?? target?.closest('li') ?? target;
            if (!!targetWrapper) {
                targetWrapper.style.transition = "all 0.3s linear";
                targetWrapper.style.opacity = "0.2";
            }
            Swal.fire({
                icon: 'warning',
                title: trans('delete'),
                text: trans("are sure to delete this item?"),
                showCancelButton: true,
                cancelButtonText: trans('cansel'),
                confirmButtonText: trans('yes'),
            }).then((result) => {
                if (result.isConfirmed) {
                    target.submit();
                } else {
                    if (!!targetWrapper) {
                        targetWrapper.removeAttribute('style');
                    }
                }
            })

        })
    })
}

const deleteRowButtons = document.querySelectorAll('.deleteItemBtn');
if (deleteRowButtons.length) {
    deleteRowButtons.forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            let targetId = btn.getAttribute('data-target')
            let target = document.getElementById(targetId);
            if (!!target) {
                target.style.transition = "all 0.3s linear";
                target.style.opacity = "0.2";
            }
            Swal.fire({
                icon: 'warning',
                title: trans('delete'),
                text: trans("are sure to delete this item?"),
                showCancelButton: true,
                cancelButtonText: trans('cansel'),
                confirmButtonText: trans('yes'),
            }).then((result) => {
                if (result.isConfirmed) {
                    target.remove();
                } else {
                    if (!!target) {
                        target.removeAttribute('style');
                    }
                }
            })

        })
    })
}

//     Icons Page     //
let IconListEl = document.querySelector('#iconList');
if (IconListEl) {
    // Use a document fragment to minimize reflows and repaints
    let fragment = document.createDocumentFragment();

    const sortedIconList = Object.entries(iconList).sort();

    sortedIconList.forEach(([key, value]) => {
        // Create section element
        let newIconItem = document.createElement('section');
        newIconItem.classList.add('xbox', 'box-item');

        // Create div for the icon and button
        let containerDiv = document.createElement('div');
        containerDiv.classList.add('flex', 'flex-col', 'justify-between', 'items-center', 'gap-3', 'p-3');

        // Create icon element
        let iconEl = document.createElement('i');
        iconEl.classList.add('tkicon', key, 'fill-none', 'stroke-gray-700');
        iconEl.setAttribute('data-icon', key);

        // Create button element
        let buttonEl = document.createElement('button');
        buttonEl.setAttribute('role', 'button');
        buttonEl.classList.add('rounded', 'border', 'border-slate-200', 'px-3', 'py-1', 'text-gray-700');
        buttonEl.textContent = key;

        // Append icon and button to container
        containerDiv.appendChild(iconEl);
        containerDiv.appendChild(buttonEl);

        // Append container to section
        newIconItem.appendChild(containerDiv);

        // Append section to the fragment
        fragment.appendChild(newIconItem);
    });

    // Insert fragment into the DOM in a single operation
    IconListEl.appendChild(fragment);
}

//     GENERAL SELECT BOX     //
if (document.querySelectorAll('.select-box').length) {
    document.querySelectorAll('.select-box').forEach(el => {
        let create = el.getAttribute('data-creation') ?? false;

        let settings = {
            create: create,
            sortField: {
                field: "text",
                direction: "asc"
            }
        };
        new TomSelect(el, settings);
    });
}


//        Seo Section        //
let SeoTypeSelector = document.getElementById('seo_type');
const SchemaDetailsSec = document.getElementById('schemaDetails');
if (!!SeoTypeSelector) {
    let seoType = SeoTypeSelector.value;
    let seoNameSpace = document.getElementById('instance') ? document.getElementById('instance').value : null;
    let seoNameSpaceId = document.getElementById('instanceId') ? document.getElementById('instanceId').value : null;
    getSchema(seoType, seoNameSpace, seoNameSpaceId)

    SeoTypeSelector.addEventListener('change', () => {
        SchemaDetailsSec.innerHTML = '';
        seoType = SeoTypeSelector.value;
        getSchema(seoType, seoNameSpace, seoNameSpaceId)
    });
}

function getSchema(seoType = 'WebPage', instance = null, id = null) {
    let waitEl = document.getElementById('waitEl');
    try {
        waitEl.innerText = 'loading ...'
        axios.post('/tkadmin/ajax/seo/types', {
                'seoType': seoType,
                'instance': instance,
                'id': id,
            },
            {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'content-type': 'text/json',
                }
            }
        )
            .then(function (response) {
                SchemaDetailsSec.innerHTML = response.data.data
            })
            .catch(function (res) {
                console.error(res)
            }).finally(() => {
            waitEl.innerText = '';
        });
    } catch (e) {
        console.error(e);
    }
}

// Seo meta Detector
class MetaDetector {
    constructor(selector, min, max) {
        this.metaDetector = document.querySelector(selector);
        this.min = min;
        this.max = max;

        if (this.metaDetector) {
            const targetId = this.metaDetector.getAttribute('data-target');
            this.inputEl = document.getElementById(targetId);

            if (this.inputEl) {
                this.updateMetaDetector();

                this.inputEl.addEventListener('input', this.debounce(this.updateMetaDetector, 100));
            }
        }
    }

    // Function to update the metaDetector text and background color
    updateMetaDetector() {
        const valueLength = this.inputEl.value.length;
        this.metaDetector.innerText = `${valueLength} / (${this.min} - ${this.max})`;

        if (valueLength < this.min) {
            this.updateClasses('bg-gray-700', ['bg-red-700', 'bg-green-700']);
        } else if (valueLength > this.max) {
            this.updateClasses('bg-red-700', ['bg-gray-700', 'bg-green-700']);
        } else {
            this.updateClasses('bg-green-700', ['bg-gray-700', 'bg-red-700']);
        }
    }

    updateClasses(addClass, removeClasses) {
        this.metaDetector.classList.add(addClass);
        removeClasses.forEach(removeClass => this.metaDetector.classList.remove(removeClass));
    }

    debounce(func, delay) {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }
}

new MetaDetector('#metaTitleIndicator', 50, 60);
new MetaDetector('#metaDescriptionIndicator', 150, 165);


// Ajax users //
if (document.querySelector('#relative_users')) {
    let relativeCourses = new TomSelect('#relative_users', {
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        // fetch remote data with debounced load function
        load: debounce(function (query, callback) {
            const url = '/tkadmin/ajax/users/get';
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    'content-type': 'application/json'
                },
                body: JSON.stringify({'title': query})
            })
                .then(response => response.json())
                .then(json => {
                    callback(json.data);
                }).catch(() => {
                callback();
            });
        }, 300), // Add debounce delay (e.g., 300ms)
        // custom rendering functions for options and items
        render: {
            option: function (item, escape) {
                return `<div class="py-2 flex">
 <div class="mb-1"><span class="p font-bold text-sm">${escape(item.title)}</span></div>
 </div>`;
            }
        },
    });
}


// General Ajax //
// selecting relative courses and episodes
let ajaxEls = document.querySelectorAll('.get-by-ajax');
if (ajaxEls.length) {
    let tomSelectInstances = {};
    ajaxEls.forEach(ajaxEl => {

        const id = ajaxEl.id;
        const valueField = ajaxEl.getAttribute('data-value-field') ?? 'id';
        const labelField = ajaxEl.getAttribute('data-label-field') ?? 'title';
        const searchField = ajaxEl.getAttribute('data-search-field') ?? 'title';
        const url = ajaxEl.getAttribute('data-url');

        tomSelectInstances[id] = new TomSelect(`#${id}`, {
            valueField: valueField,
            labelField: labelField,
            searchField: searchField,

            load: debounce(function (query, callback) {
                // Check if query length is greater than 3
                if (query.length >= 3) {
                    // Proceed to fetch data and show loader
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                            'content-type': 'application/json'
                        },
                        body: JSON.stringify({'title': query})
                    })
                        .then(response => response.json())
                        .then(json => {
                            callback(json.data);
                        })
                        .catch(() => {
                            callback();
                        });
                } else {
                    callback();
                }
            }, 300),
            onType: function (str) {
                if (str.length <= 3) {
                }
            },
            render: {
                option: function (item, escape) {
                    return `<div class="py-2 flex mb-1"><span class="p font-bold text-sm">${escape(item?.title ?? item?.name)}</span></div>`;
                }
            },

        });
    });
}



document.addEventListener('DOMContentLoaded', () => {
    iconSetter();
});
