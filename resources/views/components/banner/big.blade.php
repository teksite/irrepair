@props(['title'=>null, 'breadcrumb'=>null ,'image'=>null , 'fixed'=>true])
<header id="primaryImage" class="page-banner" role="banner">
    <div class="bg-gray-900/75 w-full min-h-screen-2/3 h-screen-2/3 bg-no-repeat bg-cover bg-center {{!$image ? 'bg-theme-7':''}} {{$fixed ? 'bg-fixed':''}}"  @if($image) style="background-image: url('{{$image}}')" @endif >
        <div class="w-full h-full flex items-center justify-center bg-gradient-radial from-black/75 to-black/90">
            <div class="grid gap-3 lg:grid-cols-2 inner-container h-full m-auto">
                <div class="flex items-center px-3">
                    <div>
                        @if($title)
                            <h1 class="text-gray-50">
                                {!! $title !!}
                            </h1>
                        @endif
                        @if($breadcrumb && count($breadcrumb))
                            <x-breadcrumb :items="$breadcrumb" class="text-white"/>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
