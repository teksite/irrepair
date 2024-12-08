const widgets = document.querySelectorAll('widget');
if(widgets.length){
    for (const widget of widgets) {
        const attributes = widget.attributes;
        const innerContent = widget.innerHTML;
        widget.innerContent = `
        لطفا کمی صبر کنید ...
      <svg class="animate-spin h-8 -8 text-blue-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="" cx="12" cy="12" r="10" stroke="#fff" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>`;
        const data = {
            attributes: {},
            innerContent: innerContent
        };

        for (let i = 0; i < attributes.length; i++) {
            const attr = attributes[i];
            data.attributes[attr.name] = attr.value;
        }

       await axios.post('/ajax/widgets/parser', data)
            .then(response => response.data)

            .then(response => {
                const newElement = document.createElement('div');
                newElement.innerHTML = response;
                widget.parentNode.replaceChild(newElement, widget)
            })
            .catch(error => {
                console.error(error);
            });
    }
}
console.log(widgets)
console.log('sdfsdfsdf')
