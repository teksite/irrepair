<x-main::admin-layout>
    @section('title' , __('modules'))
    @section('header-description' , __("in this window you can edit the :title", ['title'=>__('modules')]))


    <x-main::box class="overflow-x-auto">
        <x-main::table :header="[__('status'),__('title')]" class="data-table" :linkable="false">
            @if(count($modules))
                @foreach($modules as $module)
                    <tr class="group hover:bg-slate-100">
                        <td class="p-3 w-10 text-center">
                            <span class="relative flex items-center justify-center h-3 w-3 mx-auto"
                                  title="{{__('active')}}">
                           <span
                               class="animate-ping absolute inline-flex h-full w-full rounded-full {{Module::isEnableModule($module) ? 'bg-green-400' :'bg-red-400'}} opacity-75">
                           </span>
                           <span
                               class="relative  animate-pulse inline-flex rounded-full h-3 w-3 {{Module::isEnableModule($module) ? 'bg-green-500' :'bg-red-500'}}">
                           </span>
                           </span>
                        </td>
                        <td class="p-3">
                            <div class="flex items-center justify-between gap-12">
                                <span class="{{Module::isEnableModule($module) ? 'font-bold' :''}}">
                                   {{$module->getName()}}
                                </span>
                                <p>
                                    {{Module::getInfo($module)}}
                                </p>
                                <div class="flex items-center justify-end invisible group-hover:visible">

                                    @if(Module::getInfo($module , 'canDisable'))
                                        @if(Module::isEnableModule($module->getName()))
                                            <form method="POST" action="{{route('admin.modules.disable', $module)}}"
                                                  id="disableModule-{{$module->getName()}}">
                                                @csrf @method('PATCH')
                                            </form>
                                            <button role="button" type="button" class="text-yellow-700 text-sm"
                                                    onclick="event.preventDefault();document.getElementById('disableModule-{{$module->getName()}}').submit()">
                                                {{__('deactivate')}}
                                            </button>
                                        @else
                                            <form
                                                action="{{route('admin.modules.enable' ,['module'=>$module->getName()] )}}"
                                                method="POST" id="enableModule-{{$module->getName()}}">
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                            <a href="#" class="text-green-600 text-sm"
                                               onclick="event.preventDefault();document.getElementById('enableModule-{{$module->getName()}}').submit()">
                                                {{__('activate')}}
                                            </a>
                                        @endif
                                    @endcan
                                    @if(!Module::isEnabled($module->getName()) && Module::getInfo($module , 'canDelete'))
                                        <form method="POST" action="{{route('admin.modules.destroy', $module)}}"
                                              id="disableModule-{{$module->getName()}}">
                                            @csrf @method('DELETE')
                                        </form>
                                        <button role="button" type="button" class="text-yellow-700 text-sm"
                                                onclick="event.preventDefault();document.getElementById('disableModule-{{$module->getName()}}').submit()">
                                            {{__('delete')}}
                                        </button>

                                    @endcan
                                </div>

                            </div>
                            <p class="text-sm mb-0">
                                {{Module::getInfo($module ,'description')}}
                            </p>

                        </td>
                    </tr>
                @endforeach

            @else
                <p class="text-center">{{__('no item has found')}}</p>

            @endif
        </x-main::table>

    </x-main::box>

</x-main::admin-layout>
