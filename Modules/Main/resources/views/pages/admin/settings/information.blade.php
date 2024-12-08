<x-main::admin-layout>
    @section('title' , __(':title list',['title'=>__('information')]))
    @section('header-description' , __("in this window you can see all :title", ['title'=>__('information')]))


    <section class="mb-6">
        <x-main::box>
            <x-main::table :header="[__('title'),__('version')]" :linkable="false">

                <tr>
                    <td class="px-3 py-1">{{'server software'}}</td>
                    <td class="px-3 py-1">{{$_SERVER['SERVER_SOFTWARE']}}</td>
                </tr><tr>
                    <td class="px-3 py-1">{{'time zone'}}</td>
                    <td class="px-3 py-1">{{date_default_timezone_get()}}</td>
                </tr>
                <tr>
                    <td class="px-3 py-1">{{'php version'}}</td>
                    <td class="px-3 py-1">{{phpversion()}}</td>
                </tr>
                <tr>
                    <td class="px-3 py-1">{{'database driver'}}</td>
                    <td class="px-3 py-1">{{config('database.default')}}</td>
                </tr>
                <tr>
                    <td class="px-3 py-1">{{'cache driver'}}</td>
                    <td class="px-3 py-1">{{config('cache.default')}}</td>
                </tr>
                <tr>
                    <td class="px-3 py-1">{{'session driver'}}</td>
                    <td class="px-3 py-1">{{config('session.driver')}}</td>
                </tr>
                <tr>
                    <td class="px-3 py-1">{{'queue driver'}}</td>
                    <td class="px-3 py-1">{{config('queue.default')}}</td>
                </tr>


            </x-main::table>
        </x-main::box>
    </section>
    <section class="mb-5">
        <x-main::box>
            <x-main::table :header="[__('title'),__('version')]" :linkable="false">
            <tr>
                <td class="px-3 py-1">max upload</td>
                <td class="px-3 py-1">{{(int)(ini_get('upload_max_filesize'))}}</td>
            </tr>
                <tr>
                    <td class="px-3 py-1">max post</td>
                    <td class="px-3 py-1">{{(int)(ini_get('post_max_size'))}}</td>
                </tr>
                <tr>
                    <td class="px-3 py-1">memory limit</td>
                    <td class="px-3 py-1">{{(int)(ini_get('memory_limit'))}}</td>
                </tr>
{{--                <tr>--}}
{{--                    <td class="px-3 py-1">memory limit</td>--}}
{{--                    <td class="px-3 py-1">{{(int)(disk_free_space(storage_path()))}}</td>--}}
{{--                </tr>--}}

            </x-main::table>
        </x-main::box>

    </section>

    <section class="mb-6">
        <x-main::box>
            <h2 class="text-center">
                {{__('extensions')}}
            </h2>
            <x-main::table :header="[__('title'),__('version')]" :linkable="false">
                @foreach (get_loaded_extensions() as $ext)
                    <tr>
                        <td class="p-3">{{$ext}}</td>
                        <td class="p-3">{{phpversion($ext)}}</td>
                    </tr>
                @endforeach


            </x-main::table>
        </x-main::box>
    </section>
</x-main::admin-layout>
