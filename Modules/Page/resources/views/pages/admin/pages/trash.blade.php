<x-main::admin-trash-layout
    :indexRoute="route('admin.pages.index')"
    :restoreAllRoute="route('admin.pages.trash.restore')"
    :deleteAllRoute="route('admin.pages.trash.flush')"
    :instances="$pages"
    deleteRoute="admin.pages.trash.undo"
    restoreRoute="admin.pages.trash.prune"
    :title="__('pages')"
    :columns="['id'=>'#' ,'title'=>'title' , 'deleted at'=>'deleted_at','created at'=>'created_at']"
>
</x-main::admin-trash-layout>
