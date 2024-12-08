<?php

namespace Modules\Main\Services\Builder;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Hashing\BcryptHasher as Hasher;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\Main\Models\OneTimePassword;

class OtpBuilder
{
    protected int $length = 5;
    protected int $duration = 15; //minutes;
    protected $user; //minutes;


    public function __construct()
    {
        $this->length = config('sitesettings.otp_length', 5);
        $this->duration = config('sitesettings.otp_otp_duration', 15);
        $this->user = auth()->user();


    }


    public function create($user_id)
    {
        $generator = $this->generate($user_id);

        Cache::put($this->get_cache_key($generator['key']), $generator['value'], now()->addMinutes($this->duration));

        return $generator['value'];
    }


    protected function generate($user_id): array
    {
        $key = Str::lower(Str::random());

        $hash = Crypt::encrypt($key);

        $id = Str::random(4) . time();

        $value = $this->codeGenerator();

        Session::put('otp', [
            'key' => $hash,
            'id' => $id,
        ]);

        OneTimePassword::query()->create([
            'user_id' => $user_id,
            'key' => $hash,
            'code' => $value,
            'expired_at' => now()->addMinutes($this->duration),
        ]);

        return [
            'key' => $hash,
            'id' => $id,
            'value' => $value,
        ];
    }

    public function check(string $value): bool
    {
        if (!Session::has('otp')) {
            return false;
        }
        $key = Session::get('otp.key');

        $opt=OneTimePassword::query()->where('key', $key)->where('code', $value)->where('expired_at', '>', Carbon::now())->first();
        if (!!$opt) {
            $opt->delete();
            Session::remove('otp');
            Cache::delete($key);
            return true;
        }

        return false;
    }




    protected function get_cache_key($key): string
    {
        return 'otp_' . md5($key);
    }

    public function check_api(string $value, string $key, string $config = 'default'): bool
    {
        if (!Cache::pull($this->get_cache_key($key))) {
            return false;
        }

        return $this->hasher->check($value, $key);
    }

    public function codeGenerator()
    {
        do {
            $code = $this->generateRandomNumber($this->length);
        } while (OneTimePassword::FirstWhere('code', $code));
        return $code;
    }

    public function generateRandomNumber($length = 6)
    {
        return str_pad(rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
    }


}
