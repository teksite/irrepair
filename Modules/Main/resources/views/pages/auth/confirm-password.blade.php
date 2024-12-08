<x-main::panel-layout >
    @section('title',__('password conformation'))

    <section class="w-11/12 md:2-3/4 mx-auto my-6">
          <x-main::box>
              <p>
                  {{__('to continue the process, your password is required')}}
              </p>
              <form method="POST" action="{{ route('password.confirm') }}">
                  @csrf
                  <div class="mb-3">
                      <x-main::input.label for="password" :value="__('password')"/>
                      <x-main::input.text id="password" class="block w-full" type="password" name="password" autocomplete="current-password" required="required"/>
                      <x-main::input.error :messages="$errors->get('password')" class="mt-2"/>
                  </div>

                  <div class="flex justify-end">
                      <x-main::button.primary>
                          {{ __('confirm') }}
                      </x-main::button.primary>
                  </div>
              </form>
          </x-main::box>
      </section>
</x-main::panel-layout>
