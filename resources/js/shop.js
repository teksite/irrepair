import Swal from "sweetalert2";

class CartHandler {
    constructor(formSelector, action) {
        this.forms = document.querySelectorAll(formSelector);
        this.action = action;
        if (this.forms.length) {
            this.initialize();
        }
    }

    initialize() {
        this.forms.forEach((form) => {
            const submitBtn = form.querySelector(`button.${this.action}`);
            if (submitBtn) {
                submitBtn.addEventListener('click', (e) =>
                    this.handleCartAction(e, form, submitBtn)
                );
            }
        });
    }

    async handleCartAction(event, form, submitBtn) {
        event.preventDefault();
        const originalBtnText = submitBtn.innerHTML;
        const responseEl = this.getOrCreateResponseElement(form);

        if (this.action === "addToCart") {
            this.setSubmitButtonState(submitBtn, "wait ...", true);
            responseEl.innerHTML =
                '<span class="text-green-600 font-bold text-sm mt-3">لطفا صبر کنید</span>';
        }

        const AjaxURL = `/ajax${new URL(form.getAttribute("action")).pathname}`;
        const formData = new FormData(form);

        try {
            const response = await axios.post(AjaxURL, formData);

            if (this.action === "addToCart") {
                this.updateCartBadge(1);
                await this.handleAddToCartSuccess(response, form, submitBtn, responseEl);
            } else {
                await this.handleRemoveFromCartSuccess(form, submitBtn);
            }
        } catch (error) {
            if (this.action === "addToCart") {
                await this.handleAddToCartError(error, form, responseEl, submitBtn, originalBtnText);
            }
        }
    }

    getOrCreateResponseElement(form) {
        let responseEl = form.querySelector(".responseEl");
        if (!responseEl) {
            responseEl = document.createElement("div");
            responseEl.className = "p responseEl";
            form.appendChild(responseEl);
        }
        return responseEl;
    }

    setSubmitButtonState(button, text, disabled) {
        button.innerHTML = text;
        button.disabled = disabled;
    }

    updateCartBadge(countChange) {
        const cartBadge = document.getElementById("cartBadge");
        const currentCount = +cartBadge.innerText || 0;
        cartBadge.innerText = currentCount + countChange;
    }

    async handleAddToCartSuccess(response, form, submitBtn, responseEl) {
        responseEl.innerHTML =
            '<span class="text-green-600 font-bold text-sm mt-3">با موفقیت به سبد کالا اضافه شد</span>';
        await this.showAlert("با موفقیت انجام شد", "success");

        submitBtn.remove();
        this.addPreventAddToCartMessage(form);
    }

    addPreventAddToCartMessage(form) {
        const preventAddToCartEl = document.createElement("p");
        preventAddToCartEl.innerText = "این مورد قبلا به سبد خرید اضافه شده است";
        preventAddToCartEl.classList.add(
            "btn-solid-primary",
            "flex",
            "items-center",
            "justify-center",
            "gap-3"
        );
        form.appendChild(preventAddToCartEl);
    }

    async handleAddToCartError(error, form, responseEl, submitBtn, originalBtnText) {
        if (error.response?.status === 422) {
            this.displayValidationErrors(responseEl, error.response.data.messages);
            await this.showAlert("موارد مورد نیاز را به درستی وارد کنید", "warning");
        } else {
            await this.showAlert(
                "در فرآیند ثبت درخواست شما مشکلی به‌وجود آمده‌است، لطفا بعدا تلاش کنید",
                "error"
            );
        }
        this.setSubmitButtonState(submitBtn, originalBtnText, false);
    }

    displayValidationErrors(responseEl, messages) {
        responseEl.innerHTML = "";
        messages.forEach((message) => {
            const errorEl = document.createElement("span");
            errorEl.className = "text-red-600 text-sm";
            errorEl.innerText = message;
            responseEl.appendChild(errorEl);
        });
    }

    async handleRemoveFromCartSuccess(form, submitBtn) {
        const targetId = submitBtn.getAttribute("data-target");
        const target = document.getElementById(targetId);

        if (target) {
            target.style.transition = "all 0.3s linear";
            target.style.opacity = "0.2";
        }

        const confirmed = await this.showRemoveConfirmation();
        if (confirmed) {
            this.updateCartBadge(-1);
            target?.remove();
        } else {
            target?.removeAttribute("style");
        }
    }

    async showRemoveConfirmation() {
        const result = await Swal.fire({
            icon: "warning",
            title: "حذف",
            text: "از حذف این مورد مطمن هستید؟",
            showCancelButton: true,
            cancelButtonText: "انصراف",
            confirmButtonText: "تایید",
        });
        return result.isConfirmed;
    }

    async showAlert(title, icon, timer = 5000) {
        await Swal.fire({ title, icon, timer });
    }
}

export function initializeCartHandlers(addSelector , removeSelector) {
    new CartHandler(addSelector, "addToCart");
    new CartHandler(removeSelector, "removeFromCart");
}
