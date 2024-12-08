<div x-data=" {loading: true}" x-init="$refs.loading.classList.add('hidden')" aria-hidden="true">
    <div x-ref="loading" class="fixed inset-0 z-[200] flex items-center justify-center text-white bg-black bg-opacity-50 backdrop-blur-lg">
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             x="0px" y="250" width="250" height="30px" viewBox="0 0 24 30" xml:space="preserve">
    <rect x="0" y="0" width="4" height="10" fill="#333">
        <animateTransform attributeType="xml" attributeName="transform" type="translate" values="0 0; 0 20; 0 0"
                          begin="0" dur="0.6s" repeatCount="indefinite"></animateTransform>
    </rect>
            <rect x="10" y="0" width="4" height="10" fill="#333">
                <animateTransform attributeType="xml" attributeName="transform" type="translate" values="0 0; 0 20; 0 0"
                                  begin="0.2s" dur="0.6s" repeatCount="indefinite"></animateTransform>
            </rect>
            <rect x="20" y="0" width="4" height="10" fill="#333">
                <animateTransform attributeType="xml" attributeName="transform" type="translate" values="0 0; 0 20; 0 0"
                                  begin="0.4s" dur="0.6s" repeatCount="indefinite"></animateTransform>
            </rect>
  </svg>
    </div>
</div>
