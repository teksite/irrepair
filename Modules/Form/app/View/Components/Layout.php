<?php

namespace Modules\Form\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Layout extends Component
{

    public function __construct(public int $id ,public null|string $classes=null)
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('form::layouts.client.form-layout');
    }
}
