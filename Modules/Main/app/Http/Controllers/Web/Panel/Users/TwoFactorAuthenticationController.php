<?php

namespace Modules\Main\Http\Controllers\Web\Panel\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TwoFactorAuthenticationController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:client-two-factor-auth'),
        ];
    }

    public function index()
    {
        $user = auth()->user();
        return view('main::pages.panel.users.twofa', compact('user'));
    }


}
