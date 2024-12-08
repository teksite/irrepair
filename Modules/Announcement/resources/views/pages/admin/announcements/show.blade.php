<x-main::admin-layout >
    @section('title',__('edit :title',['title'=>__('announcement')]))
    @section('header-description',__('in this window you can see and edit the :title (:item)',['title'=>__('announcement'),'item'=>$announcement->title]))
    @section('hero-start')
        <x-main::link.header :href="route('admin.announcements.index')" :title="__('all :title',['title'=>__('announcements')])" />
    @endsection
    @section('hero-end')
        @can('announcement-delete')
            <x-main::link.delete :route="route('admin.announcements.destroy' , $announcement)" title="{{$announcement->title}}"/>
        @endcan
    @endsection
    <div class="gap-6 grid 2xl:grid-cols-3">
         <x-main::box class="2xl:col-span-2">
        <h3>{{__('announcement')}}</h3>
         <x-main::table class="mb-6 mt-6">
             <tr>
                 <th class="text-start p-3">{{__('title')}}</th>
                 <td class="p-3">{{$announcement->title}}</td>
             </tr>
             <tr>
                 <th class="text-start p-3">{{__('message')}}</th>
                 <td class="p-3">{{$announcement->message}}</td>
             </tr>
             <tr>
                 <th class="text-start p-3">{{__('pinned')}}</th>
                 <td class="p-3">{{$announcement->pinned ? __('yes') : __('no')}}</td>
             </tr>
         </x-main::table>
         <x-main::table class="">
             <tr>
                 <th class="text-start p-3">{{__('author')}}</th>
                 <td class="p-3">{{$announcement->creator->name}}</td>
             </tr>
             <tr>
                 <th class="text-start p-3">{{__('created at')}}</th>
                 <td class="p-3">{{$announcement->created_at}}</td>
             </tr>
         </x-main::table>
        </x-main::box>
        <x-main::box class="">
        <h3>{{__('details')}}</h3>
         <x-main::table class="mb-6 mt-6">
             <tr>
                 <th class="text-start p-3">{{__('creator')}}</th>
                 <td class="p-3">
                     <p>{{__('name') .': '.$announcement->info['creator']['name'] ?? '-'}}</p>
                     <p>{{__('email') .': '.$announcement->info['creator']['email'] ?? '-'}}</p>
                     <p>{{__('phone') .': '.$announcement->info['creator']['phone'] ?? '-'}}</p>
                     <p>{{__('ip') .': '.$announcement->info['creator']['ip'] ?? '-'}}</p>
                 </td>
             </tr>
             <tr>
                 <th class="text-start p-3">{{__('target')}}</th>
             </tr>
             <tr>
                 <th class="text-start p-3">{{__('pinned')}}</th>
                 <td class="p-3">{{$announcement->pinned ? __('yes') : __('no')}}</td>
             </tr>
         </x-main::table>
         <x-main::table class="">
             <tr>
                 <th class="text-start p-3">{{__('routes')}}</th>
                 <td class="p-3">{{implode(', ',$announcement->info['routes'])}}</td>
             </tr>
         </x-main::table>
        </x-main::box>
    </div>


</x-main::admin-layout>
