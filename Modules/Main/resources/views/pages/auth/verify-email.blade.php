<x-main::auth-layout>
    @section('title','email confirmation')

    <div class="p-3 my-3">
        <div class="flex items-center justify-center gap-3 mb-6">
            <i class="tkicon fill-none stroke-white block text-center" size="50" data-icon="mail"></i>
            <h1 class="text-center !text-white !mb-0">{{__('email verification')}}</h1>
        </div>
        <p class="text-gray-200 leading-9 font-semibold">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you did not receive the email, we will gladly send you another.') }}
        </p>
        <x-main::auth-session-status class="mb-4" :status="session('status')"/>
        <div class="flex items-center justify-between gap-6 my-12">
            <form method="POST" action="{{ route('verification.send') }}" class="formAction">
                @csrf
                <x-main::button.primary class="capitalize">
                    {{ __('resend verification email') }}
                </x-main::button.primary>
            </form>

            <a href="/"
               class="text-gray-200 hover:text-secondary-500 text-sm flex items-center gap-1">
                <i class="tkicon fill-none stroke-current " size="20" data-icon="home"></i>
                {{__('back to home')}}
            </a>
        </div>

    </div>
</x-main::auth-layout>


