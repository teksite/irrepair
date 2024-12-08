<x-main::admin-show-layout :instance="$inbox" method="PATCH">
    @section('title',__('show :title',['title'=>__('form')]))
    @section('header-description',__('in this window you can see details of :title (:item)',['title'=>__('receive'), 'item'=>$inbox->form->title]))
    @section('hero-start-section')
        <x-main::link.header :href="route('admin.forms.inboxes.index')" :title="__('all :title',['title'=>__('inboxes')])" />
    @endsection
    @section('hero-end-section')

    @endsection

    @section('main')
        <x-main::box class="gap-6 grid 2xl:grid-cols-3">
            <section class="2xl:col-span-2">
                <x-main::table class="bg">
                    @foreach($inbox->data as $item=>$value)
                        <tr>
                            <th class="p-3 fotn-bold">{{__($item)}}</th>
                            <td class="p-3">
                                @if(is_string($value)) {{$value}} @elseif(is_array($value)) {{implode(', ',$value)}}  @endif
                            </td>
                        </tr>

                    @endforeach
                </x-main::table>
            </section>
            <section class="2xl:col-span-1">
                <x-main::table class="">
                    <tr>
                        <th class="text-start p-3">{{__('ip')}}</th>
                        <td class="p-3">{{$inbox->ip_address}}</td>
                    </tr>
                    <tr>
                        <th class="text-start p-3">{{__('url')}}</th>
                        <td class="p-3">{{$inbox->url}}</td>
                    </tr>
                    <tr>
                        <th class="text-start p-3">{{__('who read it')}}</th>
                        <td class="p-3">{{$inbox->user_id ? $inbox->user->name ."($inbox->user_id)": ' - '}}</td>
                    </tr>
                    <tr>
                        <th class="text-start p-3">{{__('read at')}}</th>
                        <td class="p-3">{{dateAdapter($inbox->read_at) ?? '-'}}</td>
                    </tr>
                </x-main::table>
            </section>
        </x-main::box>
    @endsection
    @section('aside')
       <x-main::box>
           <span class="text-start block">{{__('note')}}</span>
          <p>
              {{$inbox->note ?? '-'}}
          </p>
       </x-main::box>

    @endsection


</x-main::admin-show-layout>
