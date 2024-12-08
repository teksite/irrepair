<x-main::admin-trash-layout
    :indexRoute="route('admin.comments.index')"
    :restoreAllRoute="route('admin.comments.trash.restore')"
    :deleteAllRoute="route('admin.comments.trash.flush')"
    :instances="$comments"
    deleteRoute="admin.comments.trash.undo"
    restoreRoute="admin.comments.trash.prune"
    :title="__('comments')"
    :columns="['id'=>'#' ,'messages'=>'message' , 'deleted at'=>'deleted_at','created at'=>'created_at']"
>
</x-main::admin-trash-layout>
