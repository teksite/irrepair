<?php

namespace Modules\Main\View\Components;

use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\View\Component;
use Illuminate\View\View;

class PanelLayout extends Component
{
    public \Illuminate\Contracts\Auth\Authenticatable $current_user;
    public function __construct()
    {
        $this->current_user=auth()->user();
    }


    public function render(): View|string
    {
        return view('main::layouts.panel.master');
    }
}
