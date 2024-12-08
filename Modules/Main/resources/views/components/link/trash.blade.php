@props(['route' ,'count'=>0])

<a href="{{$route}}" class="flex items-center justify-center gap-1 text-orange-600 font-bold hover:text-orange-900" title="{{__(':title list',['title'=>__('trashes')])}}">
    {{__('trashes')}}
    <span class="text-sm text-white inline-flex aspect-square min-w-6 p-0.5 rounded-full bg-orange-600 items-center justify-center">{{$count}}</span>
</a>


