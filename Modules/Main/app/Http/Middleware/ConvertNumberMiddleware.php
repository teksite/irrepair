<?php

namespace Modules\Main\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ConvertNumberMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $request->merge($this->convertDigits($request->all()));
        return $next($request);
    }

    private function convertDigits(array $input): array
    {
        $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabicDigits = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        array_walk_recursive($input, function (&$value) use ($persianDigits, $arabicDigits, $englishDigits) {
            if (is_string($value)) {
                $value = str_replace($persianDigits, $englishDigits, $value);
                $value = str_replace($arabicDigits, $englishDigits, $value);
            }
        });

        return $input;
    }
}
