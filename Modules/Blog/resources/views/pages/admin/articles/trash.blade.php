<x-main::admin-trash-layout
    :indexRoute="route('admin.blog.articles.index')"
    :restoreAllRoute="route('admin.blog.articles.trash.restore')"
    :deleteAllRoute="route('admin.blog.articles.trash.flush')"
    :instances="$articles"
    deleteRoute="admin.blog.articles.trash.undo"
    restoreRoute="admin.blog.articles.trash.prune"
    :title="__('pages')"
    :columns="['id'=>'#' ,'title'=>'title' , 'deleted at'=>'deleted_at','created at'=>'created_at']"
>
</x-main::admin-trash-layout>
