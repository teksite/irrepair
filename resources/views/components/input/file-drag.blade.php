@props(['accepted'=>'pdf'])
<div class="flex flex-col flex-grow mb-3">
    <div x-data="{ files: null }" id="FileUpload" class="block w-full py-2 px-3 relative bg-white appearance-none border-2 border-slate-200 rounded-md text-center hover:shadow-outline-gray">
       <span class="block mb-3">
            <i class="tkicon stroke-cyan-600 fill-none mx-auto" data-icon="cloud-arrow" size="32"></i>
       </span>
        <p class="text-gray-600 text-center text-sm">{{__('click or or drag your file')}}</p>
        <input type="file" name="file" class="absolute inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0"
               x-on:change="files = $event.target.files;" accept="{{$accepted}}"
               x-on:dragover="$el.classList.add('active')" x-on:dragleave="$el.classList.remove('active')" x-on:drop="$el.classList.remove('active')" >
        <template x-if="files !== null">
            <div class="flex flex-col space-y-1">
                <template x-for="(_,index) in Array.from({ length: files.length })">
                    <div class="flex flex-row items-center space-x-2">
                        <span class="font-medium text-gray-900" x-text="files[index].name">Uploading</span>
                    </div>
                </template>
            </div>
        </template>
    </div>
</div>
