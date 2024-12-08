@php use Modules\Menu\Models\Menu;use Modules\Menu\Models\MenuItem; @endphp
@props(['menu'=>null,'items'=>null , 'classes'=>''])
@php
    $selectedMenu=Menu::where('label',$menu)->first();
    if($selectedMenu){
           $items=MenuItem::query()->treeOf(function ($query) use($selectedMenu){
    $query->where('menu_id',$selectedMenu->id)->where('parent_id' ,0);
})->breadthFirst()->get()->sortBy('position')->toTree();
}
@endphp
<ul class="flex gap-3 items-center relative">
    @foreach($items as $item)
        <li class="">
            <a href="{{$item->url}}">
                {{$item->title}}
            </a>
            @if($item->children->count())
                <ul class="">
                    @foreach($item->children as $itm)
                        <li class="">
                            <a href="{{$itm->url}}">
                                {{$itm->title}}
                            </a>
                        </li>
                        @if($itm->children->count())
                            <ul>
                                @foreach($itm->children as $it)
                                    <li>
                                        <a href="{{$it->url}}">
                                            {{$it->title}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
