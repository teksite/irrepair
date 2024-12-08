
// Custom debounce function
export  function debounce(func, delay = 750, immediate = false) {
    let timeout;
    return function(...args) {
        const context = this;
        if (immediate && !timeout) {
            func.apply(context, args);
        }
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            timeout = null;
            if (!immediate) {
                func.apply(context, args);
            }
        }, delay);
    };
}
