@can('comment-edit')
<x-main::aside.link  :badge="\Modules\Comment\Models\Comment::query()->where('confirmed',false)->count() ?? 0" :title="__('comments')" icon="comment" :href="route('admin.comments.index')" class="mt-3  mb-3" :active="request()->routeIs('admin.comments.index')"/>
@endcan
