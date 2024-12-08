@props(['title', 'breadcrumb'=>null ,'image'=>null , 'description'=>null])
<header class="flex items-center justify-center bg-center bg-cover mb-24 {{$image==null ? 'bg-theme-6' :''}}"  @if($image) style="background-image: url('{{$image}}')" @endif >
    <div class="w-full h-full bg-primary-950/75">
    <div class="inner-container py-24 ">
        <div>
            <h1 class="text-white text-center">
                {!! $title !!}
            </h1>
            @if($description)
            <span class="block !text-gray-200 text-center">
                {{$description}}
            </span>
            @endif
            @if($breadcrumb && count($breadcrumb))
                <nav class="mt-3">
                    <x-breadcrumb :items="$breadcrumb" class="text-white mx-auto justify-center"/>
                </nav>
            @endif

        </div>
    </div>
    </div>
</header>
