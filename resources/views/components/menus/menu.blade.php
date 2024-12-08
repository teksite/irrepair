@php use Modules\Menu\Models\Menu, Modules\Menu\Models\MenuItem; @endphp
@props(['menu'=>null,'items'=>null , 'classes'=>''])
@php
    $selectedMenu=Menu::where('label',$menu)->first();
    if($selectedMenu){
    $items=MenuItem::query()->treeOf(function ($query) use($selectedMenu){
    $query->where('menu_id',$selectedMenu->id)->where('parent_id' ,0);
})->breadthFirst()->get()->sortBy('position')->toTree();
}
@endphp
@if($items && $items->count() && $selectedMenu)
    <div class="">
        <x-menus.menu-level-0 :items="$items" :menu="$selectedMenu"/>
    </div>
@endif
