@if(View::hasSection('hero-start') || View::hasSection('hero-end'))
    <x-main::box class="mb-6 flex justify-between">
        @if(View::hasSection('hero-start'))
        <div class="flex gap-1 items-center ">
              @yield('hero-start')
          </div>
        @endif
            @if(View::hasSection('hero-end'))
            <div class="flex items-center justify-end gap-3">
              @yield('hero-end')
          </div>
            @endif
  </x-main::box>
@endif
