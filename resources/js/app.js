import './bootstrap.js';
import iconSetter from "../../Modules/Main/resources/assets/js/icon.js";
import Swal from "sweetalert2";
import {initializeCartHandlers} from "./shop.js"
import {CommentSection} from './comment.js';
import AOS from 'aos';
import 'aos/dist/aos.css';


// Global Data
const CURRENT_URL = window.location.href;
const CURRENT_PATH = window.location.pathname;
const baseUrl = `${window.location.protocol}//${window.location.host}`;
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


// Loader //
const loader = `<svg class="animate-spin h-8 -8 text-blue-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="" cx="12" cy="12" r="10" stroke="#fff" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>`;

// Errors //
const errorItems = document.querySelectorAll('#errorList .errorList-item');
if (errorItems.length > 0) {
    errorItems.forEach((item, index) => {
        setTimeout(() => {
            item.remove();
        }, (index + 1) * 3000);
    });
}

// offline - online status //
function updateOnlineStatusToOffline() {
    const statusDiv = `<div dir="ltr" id="statusLine" style="position: fixed;top: 0;width:100%;z-index: 999999;;text-align: center;font-size: 12px;font-weight: bold;color: white;background-color: red">You are offline. Check your connection.</div>`;
    document.body.insertAdjacentHTML('afterbegin', statusDiv);
    window.removeEventListener('offline', updateOnlineStatusToOffline)
    window.addEventListener('online', updateOnlineStatusToOnline);
}

function updateOnlineStatusToOnline() {

    const statusDiv = document.getElementById('statusLine');
    if (statusDiv) {
        statusDiv.textContent = 'You are back!';
        statusDiv.style.backgroundColor = 'green'
        setTimeout(function () {
            statusDiv.remove();
        }, 2500);
    }
    window.removeEventListener('online', updateOnlineStatusToOnline)
    window.addEventListener('offline', updateOnlineStatusToOffline);

}

window.addEventListener('online', updateOnlineStatusToOnline);
window.addEventListener('offline', updateOnlineStatusToOffline);


// Ajax Forms //
const forms = document.querySelectorAll('form.collect-data-form');

function setSubmitButtonState(button, text, isDisabled) {
    button.innerHTML = text;
    button.disabled = isDisabled;
}

// Add validation error highlighting to invalid fields
function highlightInvalidFields(form, messages) {
    // Clear previous error classes
    form.querySelectorAll('.border-red-600').forEach(input => input.classList.remove('border-red-600'));
    // Add "border-red-600" class to fields with validation errors
    Object.keys(messages).forEach(key => {
        const input = form.querySelector(`[name="${key}"]`);
        if (input) input.classList.add('border-red-600', 'border');
    });
}

// Error handling function
function handleError(form, responseEl, messages) {
    highlightInvalidFields(form, messages);
    if (messages) {
        const errorList = Object.entries(messages)
            .filter(([key]) => key !== 'formpot')
            .map(([, message]) => `<li>${message}</li>`)
            .join('');
        responseEl.innerHTML = `<ul class="text-red-600 font-bold mt-3">${errorList}</ul>`;
    } else {
        responseEl.innerHTML = '<span class="text-red-900 font-bold mt-3">در فرآیند ثبت درخواست شما مشکلی به‌وجود آمده‌است، لطفا بعدا تلاش کنید</span>';
    }
}

//Required mark
const requiredInputs = document.querySelectorAll('input[required]');
if (requiredInputs.length) {
    requiredInputs.forEach(requiredInput => {
        let inputId = requiredInput.getAttribute('id');
        let labelEl = document.querySelector(`label[for="${inputId}"]`);
        if (labelEl) {
            labelEl.innerHTML = labelEl.innerText + '<span class="text-red-600">*</span>';
        }


    })
}

// Success and error alerts using Swal
async function showAlert(title, icon, timer = 5000) {
    await Swal.fire({title, icon, timer});
}

// Reset form and optional selected item box
function resetForm(form) {
    form.reset();
    const selectedBox = form.querySelector('#selected_item');
    if (selectedBox) selectedBox.innerHTML = '';
}

// AJAX submission handler
async function submitForm(e, form, submitBtn, primaryBtnText) {
    e.preventDefault();
    setSubmitButtonState(submitBtn, 'Loading...', true);
    const recaptchaImgEl = form.querySelector('img.recaptcha-image');

    let responseEl = form.querySelector('.responseEl');
    if (!responseEl) {
        responseEl = document.createElement('div');
        responseEl.className = 'p responseEl';
        form.appendChild(responseEl);
    }
    responseEl.innerHTML = '<span class="text-green-600 font-bold text-sm mt-3">لطفا صبر کنید</span>';

    const AjaxURL = `/ajax${new URL(form.getAttribute('action')).pathname}`;
    const formData = new FormData(form);

    try {
        const response = await axios.post(AjaxURL, formData);
        responseEl.innerHTML = '<span class="text-green-600 font-bold text-sm mt-3">با موفقیت انجام شد</span>';
        resetForm(form);
        await showAlert('با موفقیت انجام شد', "success");
        const formBoxParent = form.closest('.form-box');

        if (formBoxParent) {
            successFormSchema(formBoxParent);
            // form.remove();

        }


    } catch (error) {
        if (error.response?.status === 422) {
            handleError(form, responseEl, error.response.data.messages);
            await showAlert('موارد مورد نیاز را به درستی وارد کنید', "warning");
        } else {
            await showAlert('در فرآیند ثبت درخواست شما مشکلی به‌وجود آمده‌است، لطفا بعدا تلاش کنید', "error");
        }
    } finally {
        setSubmitButtonState(submitBtn, primaryBtnText, false);
        await changeRecaptcha(recaptchaImgEl);
    }
}

// Attach event listeners to forms
forms.forEach(form => {
    const submitBtn = form.querySelector('button[type="submit"]');
    const primaryBtnText = submitBtn.innerHTML;

    form.addEventListener('submit', (e) => submitForm(e, form, submitBtn, primaryBtnText));
});

function successFormSchema(el) {
    el.innerHTML = `<div class="flex flex-col items-center justify-center gap-6 text-green-600 mt-12">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-1/3">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>
 <span class="text-green-600 font-bold text-2xl">
    فرم با موفقیت ثبت شد
</span>
</div>`;
}

// Change recaptcha //
async function changeRecaptcha(recaptchaImgEl) {
    if (recaptchaImgEl) {
        try {
            const response = await axios.post('/ajax/captcha/reload', {}, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                }
            });
            recaptchaImgEl.src = response.data.data;
        } catch (error) {
            console.error('Error reloading captcha:', error);
        }
    }
}

// Content list in Posts pages //
const bodyArticle = document.querySelector('#bodyArticle');
if (bodyArticle) {
    const headings = bodyArticle.querySelectorAll('h1, h2, h3');
    if (headings.length > 1) {
        const contentTableEl = bodyArticle.querySelector('#tableContent');
        const tocList = document.createElement('ul');
        tocList.classList.add('list-disc', 'list-inside', 'space-y-1', 'text-sm');
        tocList.setAttribute('aria-label', 'Table of Contents');


        let counterPostHeading = 1
        headings.forEach((heading, index) => {
            if (!heading.id) {
                heading.id = `heading-${counterPostHeading}`;
                counterPostHeading++
            }

            const listItem = document.createElement('li');
            const link = document.createElement('a');
            link.classList.add('hover:text-secondary-600');

            link.textContent = heading.textContent;
            link.href = `#${heading.id}`;
            link.setAttribute('aria-label', `Jump to ${heading.textContent}`);

            // Set indentation based on heading level
            const indentLevel = parseInt(heading.tagName.charAt(1)) - 1;

            listItem.appendChild(link);
            tocList.appendChild(listItem);
        });

        contentTableEl.appendChild(tocList);
    }
}


// Autoplay //
function autoplayingVideos() {
    const autoplayVideos = document.querySelectorAll('video[autoplay]');
    if (autoplayVideos.length) {
        autoplayVideos.forEach(video => video.play());
    }
}

// Counter //
class Counter {
    constructor(counterEl) {
        this.counterEl = counterEl;
        this.start = parseInt(counterEl.getAttribute('data-count-start') ?? 0);
        this.end = parseInt(counterEl.getAttribute('data-count-end') ?? 100);
        this.speed = parseInt(counterEl.getAttribute('data-count-speed') ?? 1000); //ms
        this.textEl = counterEl.querySelector('.count');

        this.step = Math.abs(this.start - this.end) / this.speed < 0 ? Math.abs(this.start - this.end) / this.speed : 1;

        if (this.start > this.end) this.step = -this.step;

        this.time = (this.speed * this.step) / Math.abs(this.start - this.end);
    }

    startCounter() {
        const intervalId = setInterval(() => {
            this.start += this.step;

            if ((this.start >= this.end && this.step > 0) || (this.start <= this.end && this.step < 0)) {
                this.start = this.end;
                this.textEl.innerText = this.end;
                clearInterval(intervalId);
            } else {
                this.textEl.innerText = this.start;
            }
        }, this.time);
    }

    static makeCountUp(el) {
        const io = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                console.log(entry.intersectionRatio)
                if (entry.intersectionRatio > 0) {
                    new Counter(el).startCounter();
                    io.unobserve(entry.target);
                }
            });
        });
        io.observe(el);
    }

    static initialize() {
        const counterEls = document.querySelectorAll('.counterNumber');
        if (counterEls.length) {
            counterEls.forEach(Counter.makeCountUp);
        }
    }
}

// Check if a Swiper container exists
if (document.querySelector('.swiper')) {
    import('swiper').then(({default: Swiper}) => {
        import('swiper/modules').then(({Autoplay, Navigation}) => {
            // Import Swiper CSS dynamically
            Promise.all([
                import('swiper/css'),
                import('swiper/css/navigation'),
                import('swiper/css/pagination')
            ]).then(() => {
                new Swiper("#homepageSlider", {
                    modules: [Navigation, Autoplay],
                    slidesPerView: 1,
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                });

                new Swiper("#homepageCustomers", {
                    modules: [Autoplay],
                    slidesPerView: 4,
                    loop: true,
                    autoplay: {
                        delay: 1000,
                        disableOnInteraction: false,
                    },
                });
            });
        });
    }).catch(error => console.error('Error loading Swiper:', error));
}

/* circular slider*/
class RotatingDots {
    constructor(containerSelector, itemSelector, cirItemSelector, radiusFactor = 2.5, rotationInterval = 5000) {
        this.container = document.querySelector(containerSelector);
        this.fields = Array.from(document.querySelectorAll(itemSelector));
        this.cirItems = Array.from(document.querySelectorAll(cirItemSelector));

        if (this.container && this.fields && this.cirItems) {
            this.radiusFactor = radiusFactor;
            this.rotationInterval = rotationInterval;

            this.totalFields = this.fields.length;
            this.width = this.container.offsetWidth;
            this.height = this.container.offsetHeight;
            this.radius = this.width / this.radiusFactor;
            this.step = (2 * Math.PI) / this.totalFields;
            this.currentIndex = 2;
            this.init();
        }

    }

    /**
     * Initialize positions, events, and the rotation loop
     */
    init() {
        this.precomputePositions();
        this.applyPositions();
        this.addEventListeners();
        this.startRotation();
    }

    /**
     * Precompute the positions of all dots
     */
    precomputePositions() {
        this.positions = this.fields.map((field, index) => {
            const angle = this.step * index;
            const x = Math.round(this.width / 2 + this.radius * Math.cos(angle) - field.offsetWidth / 2);
            const y = Math.round(this.height / 2 + this.radius * Math.sin(angle) - field.offsetHeight / 2);
            return {field, x, y};
        });
    }

    /**
     * Apply precomputed positions to all dots
     */
    applyPositions() {
        this.positions.forEach(({field, x, y}) => {
            field.style.left = `${x}px`;
            field.style.top = `${y}px`;
        });
    }

    /**
     * Add click event listeners to the dots
     */
    addEventListeners() {
        this.fields.forEach((field, index) => {
            field.addEventListener("click", () => {
                this.currentIndex = index + 1; // Update current index
                this.setActiveTab(this.currentIndex);
            });
        });
    }

    /**
     * Set the active dot and rotate the container
     * @param {number} index - The index of the active dot (1-based)
     */
    setActiveTab(index) {
        // Remove active classes
        this.fields.forEach((field) => field.classList.remove("active"));
        this.cirItems.forEach((item) => item.classList.remove("active"));

        // Add active classes to the current dot and its corresponding CirItem
        const activeField = this.fields[index - 1];
        const activeCirItem = document.querySelector(`.CirItem${index}`);

        if (activeField) activeField.classList.add("active");
        if (activeCirItem) activeCirItem.classList.add("active");

        // Rotate the container
        const rotationAngle = 360 - (index - 1) * 36;
        this.container.style.transform = `rotate(${rotationAngle}deg)`;
        this.container.style.transition = "2s";

        // Rotate individual dots
        this.fields.forEach((field) => {
            field.style.transform = `rotate(${(index - 1) * 36}deg)`;
            field.style.transition = "1s";
        });
    }

    /**
     * Start the auto-rotation loop
     */
    startRotation() {
        setInterval(() => {
            this.currentIndex = this.currentIndex > this.totalFields ? 1 : this.currentIndex;
            this.setActiveTab(this.currentIndex);
            this.currentIndex++;
        }, this.rotationInterval);
    }
}


document.addEventListener('DOMContentLoaded', () => {
    new CommentSection();
    initializeCartHandlers('form.addToCart' ,'form.deleteFromCart')

    Counter.initialize();
    new RotatingDots(".dotCircle", ".itemDot", ".CirItem");

    autoplayingVideos();
    iconSetter();
    updateOnlineStatusToOnline();
});


