<x-main::admin-list-layout>
        @section('title' , __(':title list',['title'=>__('inboxes')]))
        @section('header-description' , __("in this window you can see all :title", ['title'=>__('inboxes')]))

        @section('hero-start-section')
            <x-main::input.select name="formal" onchange="window.location = this.value">
                    <option value="{{route('admin.forms.inboxes.index')}}">{{__('all')}}</option>
                @foreach(\Modules\Form\Models\Form::query()->select('title','id')->get() as $frm)
                    <option  {{isset($form) && $form->id ==$frm->id ? 'selected' : ''}} value="{{route('admin.forms.inboxes.index', ['form'=>$frm])}}">{{$frm->title}}</option>
                @endforeach
            </x-main::input.select>

        @can('form-delete')
                <x-main::link.trash :route="route('admin.forms.inboxes.trash.index')" count="{{$trashCount}}"/>
            @endcan
        @endsection
        @section('hero-end-section')
            <x-main::search/>
        @endsection

    @section('main')

        <x-main::box>
            <x-main::table :header="['id'=>'#','form' ,'read_at'=>'read at','created_at'=>'created at',]">
                @if($inboxes->count())
                    @foreach($inboxes as $key=>$inbox)
                        <tr class="group hover:bg-slate-100 {{$inbox->read_at ?:'font-bold'}}">
                            <td class="p-3">{{$inboxes->firstItem() + $key}}</td>
                            <td class="p-3">{{$inbox->form->title}}</td>
                            <td class="p-3">{{$inbox->read_at}}</td>
                            <td class="p-3">
                                {{$inbox->created_at}}
                            </td>
                            <td class="p-3">
                                <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                                    <x-main::link.show :blank="false" :route="route('admin.forms.inboxes.show' , $inbox)" title="{{$inbox->title}}"/>

                                @can('form-edit')
                                        <x-main::link.edit :route="route('admin.forms.inboxes.edit' , $inbox)" title="{{$inbox->title}}"/>
                                    @endcan

                                    @can('form-delete')
                                        <x-main::link.delete :route="route('admin.forms.inboxes.destroy' , $inbox)" title="{{$inbox->title}}"/>
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
                @if($inboxes?->links())
                    <x-slot:foot>
                        <tr>
                            <td colspan="4" class="p-3">
                                {{$inboxes->appends($_GET)->links()}}
                            </td>
                        </tr>
                    </x-slot:foot>
                @endif
            </x-main::table>
        </x-main::box>
    @endsection

</x-main::admin-list-layout>

