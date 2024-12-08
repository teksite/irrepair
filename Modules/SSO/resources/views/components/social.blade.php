    @foreach(\Modules\SSO\Enums\SsoTypeEnum::cases() as $item)
        @if(\Modules\Main\Models\Setting::getData($item->value."_authentication" ,"stance") =='on')
            <a href="{{route('auth.sso.redirect')}}?type={{$item->value}}" {{$attributes->merge()}} title="{{__('by :title',['title'=>__($item->value)])}}">
                <img src="{{asset('admin/images/'.$item->value.'-icon.svg') }}" alt="{{__('by :title',['title'=>__($item->value)])}}" width="35" height="35">
            </a>
        @endif
    @endforeach
