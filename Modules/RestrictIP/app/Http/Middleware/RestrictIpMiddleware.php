<?php

namespace Modules\RestrictIP\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class RestrictIpMiddleware
{
    private $ipRegex = '/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9][0-9]?)$/';

    public function handle(Request $request, Closure $next)
    {
        $userIp = $request->ip();
        $mode = config('restrcitedip.restrict_mode', 'blacklist');

        $ipList = $mode === 'blacklist' ? config('restrcitedip.black_ip', []) : config('restrcitedip.white_ip', []);

        if ($this->isIpBlocked($userIp, $ipList, $mode)) {
            $this->redirectingToUrl($request);
        }

        return $next($request);
    }

    private function isIpBlocked($userIp, array $ipList, $mode)
    {

        foreach ($ipList as $item) {

            if (is_string($item)) {
                if ($this->matchIp($userIp, $item, $mode)) {
                    return true;
                }
            } elseif (is_array($item)) {
                if ($this->matchIpRange($userIp, $item, $mode)) {
                    return true;
                }

            }
        }
        return $mode !=='blacklist';
    }

    private function matchIp($userIp, $ip, $mode)
    {
        return ($mode === 'blacklist' && $userIp === $ip) || ($mode === 'whitelist' && $userIp !== $ip);
    }

    private function matchIpRange($userIp, array $range, $mode)
    {
        $startIp = ip2long($range[0]);
        $endIp = ip2long($range[1]);
        $userIpLong = ip2long($userIp);

        return ($mode === 'blacklist' && $userIpLong >= $startIp && $userIpLong <= $endIp) ||
            ($mode === 'whitelist' && ($userIpLong < $startIp || $userIpLong > $endIp));
    }

    private function isValidIpRange(array $range)
    {
        return isset($range[0], $range[1]) &&
            preg_match($this->ipRegex, $range[0]) &&
            preg_match($this->ipRegex, $range[1]);
    }

    private function redirectingToUrl(Request $request): void
    {
        $redirectUrl = config('restrcitedip.redirect');
        if ($redirectUrl) {
            if(URL::current()!=url($redirectUrl)) redirect($redirectUrl);
        } else {
            abort(403, __('Your access has been limited.'));
        }
    }
}
