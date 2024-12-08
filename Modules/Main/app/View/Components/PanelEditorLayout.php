<?php

namespace Modules\Main\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class PanelEditorLayout extends Component
{

    public function __construct()
    {

    }

    public function render(): View|string
    {
        return view('main::layouts.panel.editor');
    }
}
