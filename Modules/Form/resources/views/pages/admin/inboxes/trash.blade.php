<x-main::admin-trash-layout
    :indexRoute="route('admin.forms.inboxes.index')"
    :restoreAllRoute="route('admin.forms.inboxes.trash.restore')"
    :deleteAllRoute="route('admin.forms.inboxes.trash.flush')"
    :instances="$inboxes"
    deleteRoute="admin.forms.inboxes.trash.undo"
    restoreRoute="admin.forms.inboxes.trash.prune"
    :title="__('forms')"
    :columns="['id'=>'#' ,'title'=>'form->title' , 'deleted at'=>'deleted_at','created at'=>'created_at']"
>
</x-main::admin-trash-layout>
