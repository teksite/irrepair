{{--<x-main::accordion-editor :title="$title" :open="$open">--}}
@if($categories->count())
    <div class="categories-box">
        <ul class="space-y-3">
            @foreach($categories as $category)
                <li>
                    <div class="flex items-center justify-between gap-3 mb-3">
                        <div class="font-bold w-fit flex items-center gap-3">
                              <span class="whitespace-nowrap p">
                                  {{ $loop->depth ? str_repeat('↚' , $loop->depth -1) : ''}}
                              </span>
                            <span class="min-w-fit w-fit text-nowrap">
                                    {{$category->title}}
                            </span>
                        </div>
                        <hr class="border-t border-dotted w-full">

                        <div class="flex items-center justify-end gap-3 w-fit">

                            @if($category->label == null)
                                @can('post-category-edit')
                                    <x-main::link.edit :route="route('admin.blog.categories.edit', $category)" title="{{$category->title}}"/>
                                @endcan

                                @can('post-category-delete')
                                    <x-main::link.delete :route="route('admin.blog.categories.destroy', $category)"
                                                         title="{{$category->title}}"/>
                                @endcan
                            @endif


                        </div>
                    </div>
                    @if($category->children->count())
                        @include('blog::layouts.admin.sections.categories-tree' ,['open'=>'false' ,'title'=>$category->tile,'categories'=>$category->children])
                    @endif
                    @if ($loop->depth ==1)
                        <hr class="my-6">
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endif

{{--</x-main::accordion-editor>--}}

