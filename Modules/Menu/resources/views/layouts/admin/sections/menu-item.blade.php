@props(['items'])
@if($items->count())
    @foreach($items->sortBy('position') as $item)
        <div x-data="{open:false}" class="item border border-dotted menu-item mb-3" itemid="{{$item->id}}"
             id="menu-item-{{$item->id}}">
            <button type="button" class="w-full flex items-center gap-3 bg-white overflow-hidden"
                    :class="open ? 'rounded-t' : 'rounded'"
                    @click="open=!open">
                <span class="handle self-stretch px-2 py-1 bg-gray-400 cursor-all-scroll">✢</span>
                <span class="text-sm">{{__($item->title)}}</span>
                <i :class="{'!-rotate-90':open}" class="tkicon ease-in-out transition-all icon-accordion" size="9" data-icon="angle-left"></i>
            </button>
            <div>
                <div x-show='open' x-cloak x-transition class="bg-white p-3 rounded-b">
                    <div class="">
                        <div class="grid md:grid-cols-2 gap-3">
                            <div class="mb-3">
                                <x-main::input.label for="title-{{$item->id}}" :value="__('title')"/>
                                <x-main::input.text class="w-full block" name="items[{{$item->id}}][title]"
                                              :value='old("items.$item->id.title") ?? $item->title' id="title-{{$item->id}}"/>
                                <x-main::input.error :messages='$errors->get("items.$item->id.title")'/>

                            </div>
                            <div class="mb-3">
                                <x-main::input.label for="url-{{$item->id}}" :value="__('url')"/>
                                <x-main::input.text class="w-full block" name="items[{{$item->id}}][url]" dir="ltr"
                                              :value='old("items.$item->id.url") ?? $item->url ?? "" ' id="url-{{$item->id}}"/>
                                <x-main::input.error :messages='$errors->get("items.$item->id.url")'/>
                            </div>
                        </div>
                        <div class="mb-3">
                            <x-main::input.label for="subtitle-{{$item->id}}" :value="__('subtitle')"/>
                            <x-main::input.text id="subtitle-{{$item->id}}" class="w-full block"
                                          name="items[{{$item->id}}][subtitle]"
                                          :value='old("items.$item->id.subtitle") ?? $item->subtitle ?? "" '/>
                            <x-main::input.error :messages='$errors->get("items.$item->id.subtitle")'/>

                        </div>
                        <div class="mb-3">
                            <x-main::input.label for="classes-{{$item->id}}" :value="__('classes')"/>
                            <x-main::input.text id="classes-{{$item->id}}" class="w-full block"
                                          name="items[{{$item->id}}][classes]" dir="ltr"
                                          :value='old("items.$item->id.classes") ?? $item->classes ?? "" '/>
                            <x-main::input.error :messages='$errors->get("items.$item->id.classes")'/>

                        </div>
                        <div class="grid gap-3 md:grid-cols-2 mb-3">
                            <div class="">
                                <x-main::input.label for="preicon-{{$item->id}}" :value="__('pre icon')"/>
                                <x-main::input.text id="preicon-{{$item->id}}" class="w-full block"
                                              name="items[{{$item->id}}][pre_icon]" dir="ltr"
                                              :value='old("items.$item->id.pre_icon") ?? $item->pre_icon ?? "" '/>
                                <x-main::input.error :messages='$errors->get("items.$item->id.pre_icon")'/>

                            </div>
                            <div class="">
                                <x-main::input.label for="nexticon-{{$item->id}}" :value="__('next icon')"/>
                                <x-main::input.text id="nexticon-{{$item->id}}" class="w-full block"
                                              name="items[{{$item->id}}][next_icon]" dir="ltr"
                                              :value='old("items.$item->id.next_icon") ?? $item->next_icon ?? "" '/>
                                <x-main::input.error :messages='$errors->get("items.$item->id.next_icon")'/>
                            </div>
                        </div>
                        <div class="mb-3">
                            <x-main::input.label for="image-{{$item->id}}" :value="__('image')"/>
                            <x-main::input.text id="image-{{$item->id}}" class="w-full block"
                                                name="items[{{$item->id}}][image]" dir="ltr"
                                                :value='old("items.$item->id.image") ?? $item->image ?? "" '/>
                            <x-main::input.error :messages='$errors->get("items.$item->id.image")'/>
                        </div>
                        <button type="button" class="text-red-700 delete-menu-item my-3" id="delete-{{$item->id}}"
                                data-for="{{$item->id}}">{{__('delete')}}
                        </button>
                    </div>
                    <div class="hidden">
                        <input type="hidden" name="items[{{$item->id}}][parent_id]" value="{{$item->parent_id}}"
                               class="parent_id">
                        <input type="hidden" name="items[{{$item->id}}][id]" value="{{$item->id}}"
                               class="item_id">
                        <input type="hidden" name="items[{{$item->id}}][id]" value="{{$item->id}}"
                               class="{{$item->id}}">
                        <input type="hidden" class="position-item" name="items[{{$item->id}}][position]"
                               value="{{$item->position}}">
                    </div>
                </div>
            </div>

            <div class="nested ps-3 border border-gray-300 my-1">
                @include('menu::layouts.admin.sections.menu-item' ,['items'=>$item->children()->get()])
            </div>
        </div>
    @endforeach
@endif
