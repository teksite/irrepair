<section>
    <fieldset class="fieldset">
        <legend>
                <h3 class="px-3 py-2 bg-white">{{__('meta data')}}</h3>
            </legend>
        <div>
                <div class="mb-3">
                    <x-main::input.label for="seoTitle" :value="__('seo title')"/>
                    <x-main::input.text  id="seoTitle" class="block w-full" type="text" name="seo[meta][title]" placeholder="{{__('seo title')}}" :value="old('seo.meta.title') ?? (isset($instance) ? $instance->seo->title ??  $instance->title ??  $instance->name : null) ?? '' "/>

                    <div class="mb-6 h-1 w-full bg-neutral-200 text-xs font-bold">
                        <div class="h-1 text-xs" id="metaTitleIndicator" data-target="seoTitle"></div>
                        <span id="metaTitleIndicator"></span>
                    </div>

                    <x-main::input.error :messages="$errors->get('seo.meta.title')" class="mt-2"/>
                </div>
                <div class="mb-3">
                    <x-main::input.label for="seoDescription" value="{{__('seo description')}}"/>
                    <x-main::input.textarea id="seoDescription" class="block w-full" name="seo[meta][description]" placeholder="{{__('seo description')}}">{{old('seo.meta.description')  ?? (isset($instance) ? $instance->seo?->description : null) ?? '' }}</x-main::input.textarea>

                    <div class="mb-6 h-1 w-full bg-neutral-200 text-xs font-bold">
                        <div class="h-1 text-xs" id="metaDescriptionIndicator" data-target="seoDescription"></div>
                    </div>

                    <x-main::input.error :messages="$errors->get('seo.meta.description')" class="mt-2"/>
                </div>
                <div class="mb-3">
                    <x-main::input.label for="seo_keyword" value="{{__('keywords')}}"/>
                    <x-main::input.text id="seo_keywords" class="block w-full" type="text" name="seo[meta][keywords]" :value="old('seo.meta.keywords') ?? (isset($instance) ? $instance->seo?->keywords->implode(',') : null) ?? ''"  placeholder="{{__('separate your keywords by ,')}}"/>
                    <x-main::input.error :messages="$errors->get('seo.meta.keywords')" class="mt-2"/>
                </div>
                <hr class="my-6">

                <div class="mb-3 flex items-center gap-3">
                    <x-main::input.label class="!mb-0" for="seo_index" value="{{__('crawled by search engines')}}"/>
                    <div class="flex items-center gap-3">
                        <x-main::input.radio id="seo_index" name="seo[meta][indexable]" value="index" :checked="old('seo.meta.indexable') =='index' || isset($instance) && $instance->seo?->indexable=='index' || ! isset($instance)"/>
                        <x-main::input.label class="!mb-0" for="seo_index" value="index"/>
                    </div>

                    <div class="flex items-center gap-3">
                        <x-main::input.radio id="seo_no_index" name="seo[meta][indexable]" value="noindex" :checked="old('seo.meta.indexable')=='noindex' || isset($instance) && $instance->seo?->indexable=='noindex'"/>
                        <x-main::input.label class="!mb-0" for="seo_no_index" value="noindex"/>

                    </div>
                </div>
                <div class="mb-3 flex items-center gap-6">
                    <x-main::input.label class="!mb-0" for="seo_follow" value="{{__('followed by search engines')}}"/>
                    <div class="flex items-center gap-3">
                        <x-main::input.radio id="seo_follow" name="seo[meta][followable]" value="follow" :checked="old('seo.meta.followable')=='follow' || isset($instance) && $instance->seo?->followable=='follow' || ! isset($instance)"/>
                        <x-main::input.label class="!mb-0" for="seo_follow" value="follow"/>
                    </div>

                    <div class="flex items-center gap-3">
                        <x-main::input.radio id="seo_no_follow" name="seo[meta][followable]" value="nofollow" :checked="old('seo.meta.followable')=='nofollow' || isset($instance) && $instance->seo?->followable=='nofollow'"/>
                        <x-main::input.label class="!mb-0" for="seo_no_follow" value="nofollow"/>

                    </div>
                </div>
                <div class="mb-3 my-6">
                    <x-main::input.label for="seo_conical_url" value="{{__('SEO conical URL')}}"/>
                    <x-main::input.text id="seo_conical_url" class="block w-full" type="url" name="seo[meta][conical_url]" placeholder="{{__('conical url (default is current url)')}}"
                                        :value="old('seo.meta.conical_url') ?? (isset($instance) ? $instance->seo?->conical_url : null) ?? ''" maxlength="255"/>
                    <x-main::input.error :messages="$errors->get('seo.meta.conical_url')" class="mt-2"/>
                </div>
            </div>
    </fieldset>
</section>
