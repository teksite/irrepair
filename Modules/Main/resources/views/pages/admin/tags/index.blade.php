<x-main::admin-credix-layout>
    @section('title',__('tags'))
    @section('header-description',__('in this window you can see all :title and create new one',['title'=>__('tags')]))

    @section('formRoute' ,route('admin.tags.store'))

    @can('tag-edit')
        @section('form')
            <div class="my-3">
                <x-main::input.label for="title" value="{{__('title')}}"/>
                <x-main::input.text id="title" class="block mt-1 w-full" type="text" name="title"
                                    :value="old('title')"/>
                <x-main::input.error :messages="$errors->get('title')" class="mt-2"/>
            </div>
        @endsection
    @endcanany

    @section('index')

        <x-main::box>
            <div class="flex justify-end items-center mb-6">
                <x-main::search/>
            </div>
            <x-main::table :header="['id'=>'#','title'=>'title',]">
                @if($tags->count())
                    @foreach($tags as $key=>$tag)
                        <tr class="group hover:bg-slate-100">
                            <td class="p-3">{{$tags->firstItem() + $key}}</td>
                            <td class="p-3">{{$tag->title}}</td>
                            <td class="p-3">
                                <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                                    @can('tag-edit')
                                        <x-main::link.edit :route="route('admin.tags.edit' , $tag)"
                                                           title="{{$tag->name}}"/>
                                    @endcan

                                    @can('tag-edit')
                                        <x-main::link.delete :route="route('admin.tags.destroy' , $tag)" title="{{$tag->name}}"/>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="p-3">
                            <p class="text-center">
                                {{__('no item has been found')}}
                            </p>
                        </td>
                    </tr>
                @endif
                @if($tags?->links())
                    <x-slot:foot>
                        <tr>
                            <td colspan="4" class="p-3">
                                {{$tags->appends($_GET)->links()}}
                            </td>
                        </tr>
                    </x-slot:foot>
                @endif
            </x-main::table>
        </x-main::box>

    @endsection

</x-main::admin-credix-layout>

