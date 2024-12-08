@section('title' , __('edit :title',['title'=>__('general seo')]))
<x-main::box class="">
    <div class="flex items-center gap-1">
        <div class="flex items-center gap-6">
            <div class="flex items-center gap-3">
                <x-main::input.radio id="status_yes" class="" name="stance" :checked="$seo->stance == 'on'" value="on"/>
                <x-main::input.label for="status_yes" :value="__('activate')" class="!mb-0"/>
            </div>
            <div class="flex items-center gap-3">
                <x-main::input.radio id="status_no" class="" name="stance" :checked="$seo->stance == 'off'" value="off"/>
                <x-main::input.label for="status_no" :value="__('deactivate')" class="!mb-0"/>
            </div>
        </div>
        <x-main::input.error :messages="$errors->get('stance')" class="mt-2"/>
        <input type="hidden" class="hidden" name="key" value="seo_general">

    </div>
        <fieldset class="fieldset my-6" >
            <legend>
                <h3>{{__('information')}}</h3>
            </legend>

    <table class="mb-3 w-full">
        <tbody id="SeoGeneralSetting">
        {{--TITLE--}}
        <tr>
            <th class="text-start min-w-fit">
                <x-main::input.label value="{{__('title')}}" for="site_title"/>
            </th>
            <td class="text-start">
                <x-main::input.text id="site_title" name="web[title]" class="block w-full"
                                    :value="old('web.title') ?? ( $seo->value['title'] ?? null) ?? __(config('app.name'))"/>
                <x-main::input.error :messages="$errors->get('web.title')"/>
            </td>

        </tr>

        {{--DESCRIPTION--}}

        <tr>
            <th class="text-start">
                <x-main::input.label value="{{__('description')}}" for="site-description"/>
            </th>
            <td class="text-start">
                <x-main::input.textarea id="site-description" rows="2" name="web[description]" class="w-full block resize-none">{{($seo->value['description']  ?? null) ?? config('app.description')}}</x-main::input.textarea>
                <x-main::input.error :messages="$errors->get('web.description')" class="mt-2"/>
            </td>
        </tr>
        {{--Language--}}
        <tr>
            <th class="text-start">
                <x-main::input.label value="{{__('language')}}" for="site-language"/>
            </th>
            <td class="text-start">
                <x-main::input.select id="site-description" class="w-full block"
                                      name="web[language]">
                    @foreach(config('global.lang') as $codeLang=>$lang)
                        <option value="{{$codeLang}}"
                            {{(old('web.language' == $codeLang) ||  (isset($seo->value['language']) && $seo->value['language'] == $codeLang ) ) ? 'selected' : ''}}>
                            {{__($lang)}}
                        </option>
                    @endforeach
                </x-main::input.select>

                <x-main::input.error :messages="$errors->get('web.language')" class="mt-2"/>
            </td>
        </tr>

        {{--Language--}}
        <tr>
            <th class="text-start">
                <x-main::input.label value="{{__('currency')}}" for="site-currency"/>
            </th>
            <td class="text-start">
                <x-main::input.select id="site-currency" class="w-full block" name="web[currency]">
                    @foreach(config('global.currency') as $codeCurrency=>$currency)
                        <option value="{{$codeCurrency}}"
                            {{(old('web.currency' == $codeCurrency) || (isset($seo->value['currency']) && $seo->value['currency'] == $codeCurrency )) ? 'selected' : ''}}>
                            {{__($currency)}}
                        </option>
                    @endforeach
                </x-main::input.select>

                <x-main::input.error :messages="$errors->get('web.currency')" class="mt-2"/>
            </td>
        </tr>

        </tbody>
    </table>
        </fieldset>

</x-main::box>
