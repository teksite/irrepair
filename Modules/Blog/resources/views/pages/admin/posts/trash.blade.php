<x-main::admin-trash-layout
    :indexRoute="route('admin.blog.posts.index')"
    :restoreAllRoute="route('admin.blog.posts.trash.restore')"
    :deleteAllRoute="route('admin.blog.posts.trash.flush')"
    :instances="$posts"
    deleteRoute="admin.blog.posts.trash.undo"
    restoreRoute="admin.blog.posts.trash.prune"
    :title="__('posts')"
    :columns="['id'=>'#' ,'title'=>'title' , 'deleted at'=>'deleted_at','created at'=>'created_at']"
>
</x-main::admin-trash-layout>
