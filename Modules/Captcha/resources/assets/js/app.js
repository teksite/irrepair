let captchaReloadEls = document.querySelectorAll('.reload-captcha-btn');

if (captchaReloadEls.length) {
    captchaReloadEls.forEach(btn => {
        // Attach event listener to each button
        btn.addEventListener('click', e => {
            e.preventDefault();
            const targetEl = e.target.closest('.reload-captcha-btn'); // Ensure we get the button even if a child element is clicked
            const codeAttr = targetEl.getAttribute('data-for');
            const imgEl = document.querySelector(`img[data-id="${codeAttr}"]`);

            if (!imgEl) return;

            targetEl.classList.add('animate-spin');

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Send AJAX request to reload captcha
            axios.post('/ajax/captcha/reload', {}, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                }
            }).then((response) => {
                if (response.data?.data) {
                    imgEl.src = response.data.data;
                }
            }).catch((error) => {
                console.error('Captcha reload failed:', error);
            }).finally(() => {
                targetEl.classList.remove('animate-spin');
            });
        });
    });
}
