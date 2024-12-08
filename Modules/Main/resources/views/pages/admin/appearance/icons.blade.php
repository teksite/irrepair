<x-main::admin-list-layout>
    @section('title',__('icon'))
    @section('header-description',__('in this window you can see all :title and create new one',['title'=>__('icon')]))




    @section('main')
        <div class="mb-3 text-gray-700" dir="ltr">
            <code class="font-bold"><<span>i</span> class='tkicon stroke-black fill-none' size='24' data-icon='example'><<span>/i</span>></code>
        </div>
        <div class="mb-3 text-gray-700" dir="ltr">
            <code class="font-bold"><<span>style</span>>
                <br>
                .tkicon.example:nth-child(1) {
                fill:none;
                stroke: #696969
                }
                <br>
                .tkicon.example:nth-child(2) {
                fill:none;
                stroke: #696969
                }
                <br>
                <<span>style</span>></code>
        </div>
        <hr class="my-3">
        <div id="iconList" class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-3 mb-3"></div>


    @endsection

</x-main::admin-list-layout>

