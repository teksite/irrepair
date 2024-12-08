import './bootstrap.js';
import iconSetter from "./icon.js";
import 'tom-select/dist/css/tom-select.css';
import Swal from "sweetalert2";
import trans from "./lang.js"


const deleteItemButtons=document.querySelectorAll('.delete-item-btn');
if(deleteItemButtons.length){
    deleteItemButtons.forEach(btn=>{
        btn.addEventListener('click',e=>{
            e.preventDefault();
            let targetId = btn.getAttribute('data-target')
            let target = document.getElementById(targetId);
            let targetWrapper = target?.closest('tr') ?? target?.closest('li') ?? target;
            if(!!targetWrapper){
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
                    if(!!targetWrapper){
                        targetWrapper.removeAttribute('style');
                    }
                }
            })

        })
    })
}


//  login slider  //
function Slider(carouselSlides) {
    const dotsSlide = document.querySelector('.dots-container');
    let currentSlide = 0;
    let currentIndexSlide = document.getElementsByClassName('active-slide')[0];
    if (!!currentIndexSlide) {
        currentSlide = currentIndexSlide.getAttribute('id')
    }
    const activeDot = function (slide) {
        document.querySelectorAll('.dot').forEach(dot => {
            dot.classList.remove('active');
            dot.removeAttribute('disabled')
        });
        document.querySelector(`.dot[data-slide="${slide}"]`).classList.add('active');
        document.querySelector(`.dot[data-slide="${slide}"]`).setAttribute('disabled', 'disabled');
    };
    activeDot(currentSlide);

    const changeSlide = function (slides) {
        carouselSlides.forEach((slide, index) =>
            (slide.style.transform = `translateX(${100 * (index - slides)}%)`));
    };
    changeSlide(currentSlide);


    dotsSlide.addEventListener('click', function (e) {
        if (e.target.classList.contains('dot')) {
            const slide = e.target.dataset.slide;
            changeSlide(slide);
            activeDot(slide);
        }
    });
}

const carouselSlides = document.querySelectorAll('.slide');
if (carouselSlides.length) {
    Slider(carouselSlides);
}



//     OTP AJAX     //
const sendTwoFactorBtnEls = document.querySelectorAll('.send2Factor');
if (sendTwoFactorBtnEls.length) {
    let forEl = document.querySelector('input[name="usage"]').value
    let typeEl = document.querySelector('input[name="type"]').value

    sendTwoFactorBtnEls.forEach(sendTwoFactorBtnEl => {
        sendTwoFactorBtnEl.addEventListener('click', e => {
            e.preventDefault();
            sendTwoFactorBtnEls.forEach(item => {
                item.disabled = true;
                item.classList.add('opacity-25')
            })
            let waitEl = document.getElementById('waitEl')
            waitEl.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; display: block;" width="60" height="60" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><path d="M10 50A40 40 0 0 0 90 50A40 45 0 0 1 10 50" fill="#fff" stroke="none"><animateTransform attributeName="transform" type="rotate" dur="1.5384615384615383s" repeatCount="indefinite" keyTimes="0;1" values="0 50 52.5;360 50 52.5"></animateTransform></path></svg>`
            try {
                axios.post('/ajax/auth/send-otp', {
                        'usage': forEl,
                        'type': typeEl,
                        'via': sendTwoFactorBtnEl.value
                    },
                    {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                )
                    .then(function (response) {
                        waitEl.innerHTML = `<p class="text-xs bg-green-600 text-white">کد یک بار مصرف به ${sendTwoFactorBtnEl.value} ارسال شد</p>`

                    })
                    .catch(function (res) {
                        console.error(res);
                        waitEl.innerHTML = `
<p class="text-sm text-red-700">
مشکلی بوجود آمده است لطفا دوباره تلاش کنید
</p>`
                    }).finally(() => {
                    sendTwoFactorBtnEls.forEach(item => {
                        item.disabled = false;
                        item.classList.remove('opacity-25')
                    })
                });
            } catch (e) {
                console.error(e);
            }
        })
    });
}


// // Profile upload image //
// const fileInput = document.getElementById('uploadFileBtn');
// const uploadFileEl = document.getElementById('uploadFilePath');
// if(fileInput && uploadFileEl){
//     fileInput.addEventListener('change',e=>{
//         uploadFileEl.value = e.target.value;
//     });
// }

iconSetter();
