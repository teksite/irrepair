<x-main::admin-layout>
    @section('title' , $name .'.log')
    @section('header-description' , __("in this window you can see all :title of :item", ['title'=>__('logs') ,'item'=>$name]))

    @section('hero-start')
        <form action="" method="get" id="changeLog">
            <x-main::input.select class="block w-full md:w-1/2"  name="log" onchange="this.form.submit()" aria-label="{{__('logs')}}" >
                @foreach($files ?? [] as $file)
                    <option value="{{$file}}" {{$name===$file ? 'selected' : ''}}>{{$file}}</option>
                @endforeach
            </x-main::input.select>
        </form>
    @endsection

    @section('hero-end')
        <form action="{{route('admin.settings.logs.clear')}}" method="POST">
            @csrf
            @method('delete')
            <input type="hidden" class="hidden" name="log" value="{{$name}}">
            <x-main::button.danger>
                {{__('clear')}}
            </x-main::button.danger>
        </form>
    @endsection
    <section class="mb-6">
        <div class="bg-zinc-900 text-gray-400 font-semibold p-6 rounded-lg w-full max-h-screen overflow-auto" dir="ltr">
            <pre>{!! $content !!}</pre>
        </div>
    </section>

</x-main::admin-layout>
