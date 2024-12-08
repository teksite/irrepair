<x-main::admin-layout>
    @section('title')
        @yield('title')
    @endsection

    @section('header-description')
        @yield('header-description')
    @endsection

    @section('hero-start')
        @yield('hero-start-section')
    @endsection

     @section('hero-end')
            @yield('hero-end-section')
            @isset($method)
                @if($method == 'PATCH' || $method == 'PUT' )
                    <x-main::button.primary type="submit" role="button" onclick="document.querySelector('form#editorForm').submit()">
                        {{__('update')}}
                    </x-main::button.primary>
                @elseif($method == 'DELETE')
                    <x-main::button.danger type="submit" role="button" onclick="document.querySelector('form#editorForm').submit()">
                        {{__('delete')}}
                    </x-main::button.danger>
                @endif
            @else
                <x-main::button.primary type="submit" role="button" onclick="document.querySelector('form#editorForm').submit()">
                    {{__('create')}}
                </x-main::button.primary>
            @endif
        @endsection

        <div>
            <form method="POST" action="@yield('formRoute')" id="editorForm">
                @csrf
                @if(isset($method) && $method == 'PATCH')
                    @method('PATCH')
                @elseif(isset($method) && $method == 'PUT')
                    @method('PUT')
                @elseif(isset($method) && $method == 'DELETE')
                    @method('DELETE')
                @endif
                <div class="w-full md:w-1/2 mb-6">
                    @yield('top')
                </div>
                <div class="mb-6 grid lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <div class="lg:col-span-2 xl:col-span-3 flex flex-col gap-6">
                        @yield('main')
                    </div>
                    <aside class="col-span-1 flex flex-col gap-6">
                        @yield('aside')
                        @includeWhen(isset($publishStatus) && $publishStatus,'main::layouts.admin.sections.publish' , ['instance'=>$instance])
                        @isset($method)
                            @if($method == 'PATCH')
                                <x-main::button.primary type="submit" role="button" onclick="document.querySelector('form#editorForm').submit()">
                                    {{__('update')}}
                                </x-main::button.primary>
                            @endif
                        @elseif($method == 'DELETE')
                            <x-main::button.danger type="submit" role="button" onclick="document.querySelector('form#editorForm').submit()">
                                {{__('delete')}}
                            </x-main::button.danger>
                        @else
                            <x-main::button.primary type="submit" role="button" onclick="document.querySelector('form#editorForm').submit()">
                                {{__('create')}}
                            </x-main::button.primary>
                        @endif
                    </aside>
                </div>
            </form>
        </div>


</x-main::admin-layout>
