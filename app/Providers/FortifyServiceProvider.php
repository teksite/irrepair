<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Modules\Captcha\Rules\CaptchaRule;
use Modules\Main\Http\Requests\Auth\LoginRequest;

class FortifyServiceProvider extends ServiceProvider
{
    private int $loop= 1;
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->routesLimiter();


        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::authenticateUsing(function (Request $request) {
            if ($this->loop < 2) {
                Validator::make($request->all(), [
                    'g-recaptcha-response' => ['required', new CaptchaRule()],
                ])->validate();
             }
            $this->loop++;
            $user = User::where('email', request()->email)->orWhere('username', request()->email)->first();

            if ($user && Hash::check(request()->password, $user->password)) {
                session()->forget('recap');

                return $user;
            }
        });

        $this->views();
    }

    public function views(): void
    {
        Fortify::loginView(fn() => View::first(['pages.auth.login', 'main::pages.auth.login']));
        Fortify::registerView(fn() => View::first(['pages.auth.register', 'main::pages.auth.register']));
        Fortify::requestPasswordResetLinkView(fn() => View::first(['pages.auth.forgot-password', 'main::pages.auth.forgot-password']));
        Fortify::resetPasswordView(fn() => View::first(['pages.auth.reset-password', 'main::pages.auth.reset-password']));
        Fortify::verifyEmailView(fn() => View::first(['pages.auth.verify-email', 'main::pages.auth.verify-email']));
        Fortify::confirmPasswordView(fn() => View::first(['pages.pages.auth.confirm-password', 'main::pages.auth.confirm-password']));
        Fortify::twoFactorChallengeView(fn() => View::first(['pages.auth.two-factor-challenge', 'main::pages.auth.two-factor-challenge']));
    }

    public function routesLimiter(): void
    {
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
