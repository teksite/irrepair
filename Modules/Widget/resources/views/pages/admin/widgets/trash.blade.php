<x-main::admin-trash-layout
    :indexRoute="route('admin.widgets.index')"
    :restoreAllRoute="route('admin.widgets.trash.restore')"
    :deleteAllRoute="route('admin.widgets.trash.flush')"
    :instances="$widgets"
    deleteRoute="admin.widgets.trash.undo"
    restoreRoute="admin.widgets.trash.prune"
    :title="__('widgets')"
    :columns="['id'=>'#' ,'title'=>'title' ,'label'=>'label' , 'deleted at'=>'deleted_at','created at'=>'created_at']"
>



</x-main::admin-trash-layout>
