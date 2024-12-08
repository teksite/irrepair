<div aria-label="{{__('table of contents')}}" class="mb-12 bg-gray-50 p-6 rounded-lg" x-data="{
        activeAccordion: '',
        setActiveAccordion(id) {
            this.activeAccordion = (this.activeAccordion == id) ? '' : id
        }
    }" >
    <div x-data="{ id: $id('accordion') }" class="cursor-pointer group">

    <button @click="setActiveAccordion(id)" class="flex items-center justify-between w-full p-1 text-left select-none group-hover:underline">
        <span>سرفصل‌ها</span>
        <svg class="w-4 h-4 duration-200 ease-out" :class="{ 'rotate-180': activeAccordion==id }" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
    </button>
    <nav x-show="activeAccordion==id" x-collapse x-cloak class="tableContent"  id="tableContent"></nav>
    </div>
</div>
