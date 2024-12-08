<x-client-layout :seo="$seo">
<x-slot name="editAddressPage">{{route('admin.pages.edit',$page)}}</x-slot>

    <main id="page-content" class="about-page">
        <x-banner.big :title="$page->title" :image="$page->banner" :breadcrumb="$page->breadcrumb()"/>
        <section class="mt-24 mb-24 inner-container">
            {!! $page->body !!}
        </section>
    </main>


</x-client-layout>
