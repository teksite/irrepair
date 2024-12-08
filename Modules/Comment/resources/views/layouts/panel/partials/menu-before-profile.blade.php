@can('client-comment-read')
        <x-main::aside.link :title="__('comments')" icon="comment" :href="route('panel.comments.index')" class="mt-6"/>
@endcan
