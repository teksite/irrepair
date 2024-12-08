<?php

namespace Modules\Main\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AdminCredixLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('main::layouts.admin.credix');
    }
}
