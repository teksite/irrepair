<x-main::admin-list-layout>
        @section('title' , __(':title list',['title'=>__('forms')]))
        @section('header-description' , __("in this window you can see all :title", ['title'=>__('forms')]))

        @section('hero-start-section')
            @can('form-create')
                <x-main::link.header :title="__('new :title',['title' =>__('form')])" :href="route('admin.forms.create')"/>
            @endcan
                @can('form-delete')
{{--                    <x-main::link.trash :route="route('admin.forms.trash.index')" count="{{$trashCount}}"/>--}}
                @endcan
        @endsection
        @section('hero-end-section')
            <x-main::search/>
        @endsection

    @section('main')

        <x-main::box>
            <x-main::table :header="['id'=>'#','title'=>'title' ,'template','created_at'=>'created at',]">
                @if($forms->count())
                    @foreach($forms as $key=>$form)
                        <tr class="group hover:bg-slate-100">
                            <td class="p-3">{{$forms->firstItem() + $key}}</td>
                            <td class="p-3">{{$form->title}}</td>
                            <td class="p-3">{{$form->template ?? __('default')}}</td>
                            <td class="p-3">{{$form->created_at}}</td>
                            <td class="p-3">
                                <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                                    @can('form-edit')
                                        <x-main::link.edit :route="route('admin.forms.edit' , $form)" title="{{$form->title}}"/>
                                    @endcan

                                    @can('form-delete')
                                        <x-main::link.delete :route="route('admin.forms.destroy' , $form)" title="{{$form->title}}"/>
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
                @if($forms?->links())
                    <x-slot:foot>
                        <tr>
                            <td colspan="4" class="p-3">
                                {{$forms->appends($_GET)->links()}}
                            </td>
                        </tr>
                    </x-slot:foot>
                @endif
            </x-main::table>
        </x-main::box>
    @endsection

</x-main::admin-list-layout>

